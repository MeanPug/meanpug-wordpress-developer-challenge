# 🐾 Pug & Puggle, ESQ — Content Schema

> The data layer for a very good (legal) boy.
>
> A small, focused WordPress plugin that registers the custom post types,
> taxonomies, and Advanced Custom Fields groups that the **infra** theme already
> expects — so the firm's structured content has a home that **outlives any single
> theme**.

---

## Why a plugin and not the theme?

Themes are clothing; data is the dog. You can put your pug in a new sweater every
season, but it's the same pug underneath.

The infra theme **reads** a whole catalog of post types and ACF fields
(`practice-area`, `team`, `office`, `local`, `testimonials`, plus a pile of custom
fields) but ships with **empty** `inc/cpt/all.php` and `inc/tax/all.php` stubs — it
never registers any of them. That's the classic WordPress footgun: register your
content model in the theme, switch themes, and every attorney, office, and Google
review schema entry silently evaporates.

So we put the content model where it belongs — in a **plugin**:

- ✅ **Portable** — switch or rebuild the theme; the data model stays put.
- ✅ **Single source of truth** — every CPT/taxonomy/field the theme consumes is
  declared in exactly one place.
- ✅ **Zero fatals** — we register precisely what the theme reads, nothing it
  doesn't, so no `call to a member function on null` surprises in production.
- ✅ **Schema-first** — these models feed the JSON-LD generators in
  `theme/inc/utils/seo/schema.php` (LocalBusiness, Review, FAQ, Attorney…).

---

## Requirements

| Dependency | Version | Notes |
| --- | --- | --- |
| WordPress | 5.8+ | Uses the block editor / `show_in_rest`. |
| PHP | 7.0+ | Matches the theme's `Requires PHP`. Tested on 8.2. |
| **Advanced Custom Fields PRO** | 5.8+ | **Required for the field groups.** The CPTs and taxonomies work without it; the ACF groups self-disable if ACF is absent (see [The ACF guard](#the-acf-guard)). |

> **Heads up on ACF Pro:** it's a commercial, licensed plugin, so it is **not**
> bundled here. Install it into your environment separately (Docker note below).

---

## Installation & activation

### Local (Docker)

The `wordpress` service in `challenge-2/docker-compose.yml` stores
`wp-content/plugins` in a **named volume** (`wp_plugins`), which would normally hide
a plugin that lives in the repo. We bind-mount this plugin over the top so a fresh
`docker compose up` is fully reproducible:

```yaml
# challenge-2/docker-compose.yml  →  services.wordpress.volumes
- ./plugins/pug-puggle-schema:/var/www/html/wp-content/plugins/pug-puggle-schema
```

Then:

```bash
cd challenge-2
docker compose up -d
```

1. Visit `http://localhost:8000/wp-admin` → **Plugins**.
2. Install/activate **Advanced Custom Fields PRO** (licensed — drop it into the
   `wp_plugins` volume or upload via the admin UI).
3. Activate **Pug & Puggle, ESQ — Content Schema**.

On activation the plugin registers everything and **flushes rewrite rules once**, so
the new archive URLs (`/practice-areas/`, `/attorneys/`, `/offices/`,
`/locations/`, `/case-results/`) resolve immediately — no "save permalinks twice"
dance required.

> No WP-CLI service is wired into this compose file, so activation is done through
> the admin UI. If you add WP-CLI, `wp plugin activate pug-puggle-schema` does the
> same thing.

---

## What it registers — the contract

Every entry below exists because **the theme already reads it**. This is a
consumer-driven contract, not a wishlist.

### Custom post types

| Post type key | Label | Hierarchical | Archive slug | Why the theme needs it |
| --- | --- | --- | --- | --- |
| `practice-area` | Practice Area | ✅ | `/practice-areas/` | Practice-area schema, child-topic accordion, widget. |
| `team` | Attorney | — | `/attorneys/` | Attorney profiles + `attorney-sidebar`/`attorney-header`. |
| `office` | Office | — | `/offices/` | `LocalBusiness` schema (address + geopoint). |
| `local` | Area Served | ✅ | `/locations/` | Location-navigator; nested area-served landing pages. |
| `testimonials` | Testimonial | — | `/testimonials/` | `Review` schema + aggregate rating. |
| `case-result` | Case Result | — | `/case-results/` | PI-firm staple; verdicts/settlements + schema. |

> `testimonials` is intentionally **plural** as a key — that's the exact name the
> theme queries (`is_post_type_archive('testimonials')`). We match the theme; we
> don't "correct" it and break it.

### Taxonomies

| Taxonomy key | Label | Hierarchical | Attached to | Why |
| --- | --- | --- | --- | --- |
| `area-served` | Area Served | ✅ | `local`, `practice-area`, `office`, `case-result` | Powers the (currently commented-out) `tax_query` in `inc/services/locations.php`. |
| `attorney-role` | Attorney Role | — | `team` | Filter/group attorneys by role (partner, associate…). |

### ACF field groups (all guarded)

| Group | Location | Key fields (names match what the theme reads) |
| --- | --- | --- |
| Firm Settings | Options: `theme-general-settings` | `contact_phone`, `contact_email`, `contact_main_address` (group), `contact_offices` (relationship→office), `social_profiles` (repeater), `schema_aggregate_rating` (group), `technical_google_maps_api_key`, `ask_a_question_form_id`, `default_evaluation_form_header` |
| Office | `office` | `address` (group), `geopoint` (group: lat/lng) |
| Testimonial | `testimonials` | `reviewer` (group: name), `rating` (0–5) |
| Practice Area | `practice-area` | `testimonials` (relationship→testimonials) |
| Area Served | `local` | `content_type`, `area_type`, `geopoint` (group) |
| Attorney | `team` | `position`, `email`, `phone`, `bar_admissions` |
| Case Result | `case-result` | `amount`, `result_type`, `year`, `related_practice_area` |
| FAQ | `post` + `practice-area` | `schema_faq_items` (repeater: question/answer) |
| Related Content | `post` + `page` + `local` | `practice_areas` (relationship→practice-area) |

Field **names** are deliberately exact: `geopoint.lat`, `reviewer.name`,
`schema_aggregate_rating.value`, etc. The schema generators read these by name, so a
typo here is an empty `<script type="application/ld+json">` in production.

---

## The ACF guard

The one piece of reviewer feedback on the reference submissions was a **missing ACF
guard** — a plugin that calls `acf_add_local_field_group()` unconditionally will
throw a fatal `Call to undefined function` the moment ACF is deactivated or a
license lapses. A schema plugin should never be able to white-screen the site.

Here, **every** ACF registration is gated:

```php
// inc/fields/all.php
function pps_register_acf_fields() {
    // If ACF (or ACF Pro) isn't active, bow out quietly — no fatals, no field
    // groups, and the CPTs/taxonomies still work perfectly fine on their own.
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    pps_register_firm_settings_fields();
    pps_register_office_fields();
    // …all nine groups…
}
add_action( 'acf/init', 'pps_register_acf_fields' );
```

The guard lives at the single entry point, and registration is hooked on `acf/init`
(which only fires when ACF is present) — belt **and** braces.

---

## Known theme inconsistency (documented, not silently patched)

The review-import hook in `theme/inc/hooks.php` writes a **flat** field:

```php
update_field( 'reviewer_name', $name, $post_id );
```

…but the testimonial schema generator in `theme/inc/utils/seo/schema.php` reads a
**grouped** field:

```php
$reviewer = get_field( 'reviewer' );   // expects $reviewer['name']
```

These two halves of the theme disagree about the shape of the same data. This plugin
registers the **grouped** `reviewer.name` field (the shape the schema actually
consumes, so JSON-LD is correct), and we're flagging the import-side mismatch here
rather than quietly mutating inherited theme behavior. Fixing the importer is a
theme change and a separate decision — see the PR notes.

---

## Design principles

- **Consumer-driven** — register only what the theme reads; no speculative fields.
- **DRY labels** — `inc/helpers.php` builds full, translatable label sets for every
  CPT and taxonomy so we're not copy-pasting 18 label strings per post type.
- **i18n throughout** — every user-facing string is wrapped in `__()` /
  `esc_html__()` against the `pug-puggle-schema` text domain.
- **Predictable lifecycle** — taxonomies register on `init` priority 9 (before the
  CPTs at priority 10) so `object_type` attachments always resolve.
- **Tidy activation** — rewrite rules flush exactly once on activate/deactivate,
  never on every request.

---

## Uninstall behavior

Deactivating the plugin **unregisters the post types and fields but does not delete
any content** — your attorneys, offices, and reviews stay in the database. (A plugin
that nukes the firm's data on deactivate is not a good boy.) Rewrite rules are
flushed on deactivation so stale archive routes don't linger.

---

## File map

```
pug-puggle-schema/
├── pug-puggle-schema.php      # Bootstrap: constants, requires, activation hooks
├── inc/
│   ├── helpers.php            # DRY label builders
│   ├── cpt/
│   │   ├── all.php            # Registrar: hooks all 6 CPTs on init
│   │   ├── practice-area.php  ├── team.php      ├── office.php
│   │   ├── local.php          ├── testimonials.php └── case-result.php
│   ├── tax/
│   │   ├── all.php            # Registrar: hooks both taxonomies on init:9
│   │   ├── area-served.php    └── attorney-role.php
│   └── fields/
│       ├── all.php            # Guarded registrar on acf/init
│       └── firm-settings.php … related.php   # 9 field groups
└── README.md                  # You are here. Good human.
```

---

_Authored for the MeanPug WordPress Developer Challenge. No pugs were billed at
partner rates in the making of this plugin._
