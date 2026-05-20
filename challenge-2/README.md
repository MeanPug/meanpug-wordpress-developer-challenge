# Challenge 2 — Pug & Puggle, ESQ

> *"Nothing's sexier than a solid schema."*

A WordPress backend for a fictional law firm. The prompt asked for **plugins, custom post types, taxonomies, a sane project structure, and any additional data structures relevant to a complete implementation**. This README is the reviewer-facing summary of what was delivered, the decisions behind it, and how to evaluate it.

---

## TL;DR — what's in the box

- **6 Custom Post Types**: Attorney, Practice Area (hierarchical), Case Result, Office, Testimonial, FAQ.
- **3 Taxonomies**: Attorney Specialty (flat), Practice Area Category (hierarchical), Area Served (hierarchical, shared across CPTs).
- **9 Gutenberg blocks** powering the homepage and landing-page content model.
- **JSON-LD schema layer** emitting Person, LegalService, Review, LocalBusiness, and BreadcrumbList markup on the relevant single/archive views.
- **Idempotent demo-content seeder** triggered from an admin notice — fills the entire content model with believable data in one click.
- **Cached query layer** (`PugPuggle\Queries\*`) that returns post-ID arrays from transient-backed reads, auto-flushed on save / delete.
- **PHP-defined ACF field groups** so the data model is reproducible from a fresh database with zero admin clicking.
- **Docker stack** (MySQL 8 + WordPress 6.7 + WP-CLI 2.10), all images pinned for reproducible builds.
- **PHPCS + ESLint** wired in via Composer / npm scripts.

---

## Getting started

```bash
cd challenge-2
docker compose up -d
# Visit http://localhost:8000 → walk through the 30-second WP installer.
# Sign in to /wp-admin → click "Install demo content" on the admin notice.
```

That's it. The `wpcli` service auto-installs and activates ACF and the theme on first boot; the demo-content seeder takes over from there.

> All Docker images are pinned (`mysql:8.0`, `wordpress:6.7-php8.2-apache`, `wordpress:cli-2.10-php8.2`) — no surprise upgrades on `docker compose up` six months from now.

---

## What was delivered, in detail

### Custom Post Types

| CPT | Slug | Archive | Notes |
|---|---|---|---|
| Attorney | `attorney` | `/attorneys/` | Admin list shows headshot + position columns. |
| Practice Area | `practice-area` | `/practice-areas/` | Hierarchical (page-attributes support) for parent/child practice areas. |
| Case Result | `case-result` | `/case-results/` | Result type + amount fields drive Review schema. |
| Office | `office` | `/offices/` | Admin list shows image + city/state. Emits LocalBusiness schema. |
| Testimonial | `testimonials` | `/testimonials/` | Plural slug intentional — matches downstream review-sync integration. |
| FAQ | `faq` | (admin-only) | `public => false, show_ui => true`. Used as content source for the FAQ accordion block. |

All six CPTs extend [`PugPuggle\Cpt\Base`](theme/inc/classes/Cpt/Base.php), which enforces a `slug()` + `args()` shape and provides optional `admin_columns()` / `render_admin_column()` hooks for list-table customisation. Adding a seventh CPT is roughly 30 lines.

### Taxonomies

| Taxonomy | Slug | Hierarchical | Attached to |
|---|---|---|---|
| Attorney Specialty | `attorney-specialty` | No | attorney |
| Practice Area Category | `practice-area-category` | Yes | practice-area |
| Area Served | `area-served` | Yes | practice-area, office, attorney |

Same pattern via [`PugPuggle\Tax\Base`](theme/inc/classes/Tax/Base.php). Area Served is deliberately multi-CPT so you can answer "which attorneys / offices / practice areas serve Brooklyn?" with one query.

### Gutenberg blocks

9 server-rendered blocks under [`theme/blocks/`](theme/blocks/), each shipping `block.json` + `*.php` (render) + `*.editor.js` (sidebar controls):

`hero-banner` · `attorney-grid` · `practice-areas-grid` · `case-results` · `testimonial-slider` · `cta-banner` · `faq-accordion` · `office-map` · `stats-counter`

Every block:

- Declares an `example` attribute so the block inserter shows a meaningful preview.
- Conditionally enqueues its own CSS/JS via [`PugPuggle\Assets::enqueue_block()`](theme/inc/classes/Assets.php) — no global block bundle.
- Uses the cached query layer for any post lookups; grid blocks prime post/meta/term caches once per render to keep query counts flat.
- Escapes every output via `esc_html` / `esc_attr` / `esc_url` / `wp_kses_post` / `wp_json_encode`.

### Schema.org / JSON-LD

[`PugPuggle\Schema`](theme/inc/classes/Schema.php) emits structured data on the relevant single / archive views:

| Page | Schema types |
|---|---|
| Single Attorney | `Person` + `BreadcrumbList` |
| Single Practice Area | `LegalService` + `BreadcrumbList` (hierarchical breadcrumbs) |
| Single Case Result | `Review` (5-star, links itemReviewed → practice area) + `BreadcrumbList` |
| Single Office | `LocalBusiness` + `OpeningHoursSpecification` + `GeoCoordinates` + `BreadcrumbList` |
| FAQ accordion block | `FAQPage` |

All output is wrapped in `<!-- SCHEMA: ... -->` comments to make audits trivial, and uses `https://schema.org` as the `@context`.

### Cached query layer

Anything that lists posts goes through [`PugPuggle\Queries\*`](theme/inc/classes/Queries/):

- `Attorneys::cards()`, `Practice_Areas::cards()`, `Case_Results::recent()`, `Offices::all()`, `Testimonials::recent()` — all return **arrays of post IDs**, stored in transients keyed by a hash of the input args.
- `Attorney_Specialty::popular()`, `Practice_Area_Category::all_with_counts()`, `Area_Served::all()` — taxonomy variants for term-driven UI.
- Each class registers its own save/delete/edited hooks via a one-line `register()` call; [`Queries\Registrar`](theme/inc/classes/Queries/Registrar.php) dispatches them all from `Bootstrap::init()`.
- Flush is a single `DELETE FROM options WHERE option_name LIKE _transient_pp_q_<prefix>%` — bounded, prefix-scoped, no over-deletion.

Block render templates `_prime_post_caches()` the ID array once before iterating, so per-post `get_post()` / `get_the_terms()` / `get_field()` calls hit the object cache instead of the DB.

### Demo content seeder

[`PugPuggle\Demo_Content`](theme/inc/classes/Demo_Content.php) is mounted in `wp-admin` as a dismissible admin notice with a nonce-protected install button. One click seeds:

- ~6 attorneys with specialties + photos
- ~5 practice areas (hierarchical: parent + child)
- ~5 case results with amounts + result types
- ~3 offices with addresses + geopoints + hours
- ~5 testimonials with reviewer names + 5-star ratings
- ~5 FAQs
- Term hierarchies for all three taxonomies

**Idempotent**: each seeded post carries a `_pugpuggle_seed_key` meta. Re-running the seeder updates instead of duplicating.

### ACF field groups

All ACF field groups consumed by the new code (Schema, demo content, blocks) are registered **in PHP** at [`theme/inc/acf/field-groups.php`](theme/inc/acf/field-groups.php) via `acf_add_local_field_group()`. Why: a reviewer cloning the repo gets the full content model on first boot — no need to click through the ACF admin UI or import a JSON dump.

The empty [`theme/acf-json/`](theme/acf-json/) directory is preserved so any field groups *added later via the ACF admin* will auto-save there for version control.

---

## Architecture decisions (and the reasoning)

**Hybrid procedural + OOP layer.** The original scaffold uses a procedural `inf_*` style in `theme/inc/*` and assumes a parent theme. New code lives in a PSR-4 `PugPuggle\` namespace under `theme/inc/classes/`, autoloaded via Composer, and bootstrapped from `Bootstrap::init()`. The procedural layer is left intact so the parent-theme integration still works.

**`Base` abstract classes for CPTs and taxonomies.** Forces a consistent registration shape and centralises the boilerplate (`register_post_type`, admin column hooks, etc.). The cost: a thin layer of indirection. The benefit: zero copy-paste drift across six CPTs.

**Queries return post IDs, not `WP_Post` objects.** Transients stay small (a few hundred bytes for a typical list), and the caller can `_prime_post_caches()` once before iterating. The block render is then O(1) DB queries regardless of result-set size.

**JSON-LD over inline microdata.** Easier to validate (Google Rich Results test, Schema.org validator), easier to audit (wrapped in HTML comments), and keeps presentation markup clean.

**ACF defined in PHP first, JSON second.** PHP-defined groups ship with the code and need no manual import. The `acf-json/` directory is still wired up so a designer adding fields via the admin gets automatic version-controlled exports.

**Demo content as a seeder, not a SQL dump.** A SQL dump rots; a seeder is testable, idempotent, and stays in sync with the field definitions in this repo.

---

## Code quality

- **PHPCS**: [`theme/phpcs.xml.dist`](theme/phpcs.xml.dist) enforces WordPress-Extra + PHPCompatibility (PHP 8.0+, WP 6.0+). Composer `lint` / `lint:fix` scripts wired in [`theme/composer.json`](theme/composer.json).
- **ESLint**: root [`.eslintrc`](.eslintrc); `npm run lint:js` and `npm run lint` (runs both PHP + JS) added to [`package.json`](package.json).
- **Escaping discipline**: every echo goes through `esc_html` / `esc_attr` / `esc_url` / `wp_kses_post` / `wp_json_encode`. External webhook data (e.g. the `mpdreviews` integration in [`theme/inc/hooks.php`](theme/inc/hooks.php)) is sanitised at the boundary before reaching `wp_insert_post`.
- **`strict_types = 1`** on every new PHP file in the `PugPuggle\` namespace.
- **`package-lock.json` committed** for reproducible npm installs.

---

## File structure tour

```text
challenge-2/
├── docker-compose.yml              # Pinned MySQL 8 + WP 6.7 + WP-CLI 2.10
├── docker/
│   ├── static/Dockerfile           # Node build container
│   └── wpcli/init.sh               # First-boot WP install + ACF activation
├── package.json + package-lock.json
├── webpack/ + gulpfile.js + tailwind.config.js
└── theme/
    ├── composer.json               # PSR-4 PugPuggle\ → inc/classes/
    ├── functions.php               # Procedural setup + block registration + class autoloader
    ├── style.css + screenshot.png  # Theme metadata
    ├── phpcs.xml.dist              # WPCS + PHPCompatibility ruleset
    ├── acf-json/                   # ACF UI exports land here (currently empty)
    ├── inc/
    │   ├── acf/field-groups.php    # PHP-defined ACF groups for the 6 CPTs
    │   ├── hooks.php               # Hook wiring (schema output, webhook handlers)
    │   ├── filters.php
    │   └── classes/                # PSR-4 root — new code lives here
    │       ├── Bootstrap.php       # init() dispatcher
    │       ├── Assets.php          # Per-block conditional enqueue
    │       ├── Schema.php          # JSON-LD emitters (Person/LegalService/Review/etc)
    │       ├── Demo_Content.php    # Idempotent admin-notice seeder
    │       ├── Widgets.php
    │       ├── Cpt/                # 6 CPTs + Base abstract
    │       ├── Tax/                # 3 taxonomies + Base abstract
    │       └── Queries/            # Cached query layer (CPT + taxonomy)
    ├── blocks/                     # 9 Gutenberg blocks, source
    │   ├── attorney-grid/
    │   ├── case-results/
    │   ├── cta-banner/
    │   ├── faq-accordion/
    │   ├── hero-banner/
    │   ├── office-map/
    │   ├── practice-areas-grid/
    │   ├── stats-counter/
    │   └── testimonial-slider/
    ├── dist/                       # Compiled block assets (gulp/webpack output)
    └── template-parts/
        └── cards/                  # Reusable card markup for grid blocks
```

---

## Verifying the implementation

| Check | How |
|---|---|
| Stack boots | `docker compose up -d`, then visit `http://localhost:8000` |
| PHPCS clean | `cd theme && composer install && composer run-script lint` |
| Demo data installs | `/wp-admin/` → "Install demo content" notice → click |
| Archives render | Visit `/attorneys/`, `/practice-areas/`, `/case-results/`, `/offices/` |
| Schema emits correctly | View-source on a single attorney → look for two `<script type="application/ld+json">` blocks with `https://schema.org` |
| Schema validates | Paste rendered HTML into [Google's Rich Results Test](https://search.google.com/test/rich-results) |
| No N+1 in grid blocks | Enable Query Monitor → load a page with `attorney-grid` → query count is bounded, no per-post `SELECT * FROM wp_posts WHERE ID = …` |
| Cache invalidates | Edit an attorney → transient `_transient_pp_q_att_*` disappears from `wp_options` |
| Block previews show | Block inserter → each Pug & Puggle block shows a preview thumbnail |

---

## Known limitations / intentionally out of scope

- The procedural `inc/` layer carries some MeanPug-parent-theme conventions (`jQuery` re-registration in `functions.php`, `mp_*` hooks, the MeanPug core CDN script). They're guarded with `function_exists()` checks so the theme degrades cleanly when the parent theme isn't bundled — kept as-is to match the scaffold's intent rather than rewritten.
- Google Maps SDK loading is the parent theme's responsibility; the `office-map` block renders the address list and pin data either way.
- No automated test suite. Out of scope for a tech test of this size, but the architecture (DI via class registration, ID-returning queries, side-effect-free render templates) is test-friendly — `PHPUnit` + WP testing harness would slot in cleanly.
- `Demo_Content.php` references *some* fields that are defined in the parent theme's ACF setup; those are guarded behind `function_exists('update_field')` and silently no-op if ACF isn't active.

---

## Required plugins

Auto-installed by `docker/wpcli/init.sh` on first boot:

- **Advanced Custom Fields** — backs the field model defined in `theme/inc/acf/field-groups.php`.

Recommended (referenced by parent-theme hooks but optional for the core challenge):

- **Max Mega Menu** — used by the parent theme's nav system.
- **Gravity Forms** — used by the `mpdcontent/ask-question/submission` hook in `theme/inc/hooks.php`.
- **Yoast SEO** — meta + sitemap output complements the JSON-LD layer.

The theme runs cleanly without the three recommended plugins; parent-theme integrations no-op via `function_exists()` guards.
