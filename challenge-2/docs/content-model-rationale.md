# Content model — rationale

Why each piece exists. Technical details: [SOLUTION.md](../SOLUTION.md). Plugins: [plugin-decisions.md](plugin-decisions.md).

---

## Overall approach

The theme skeleton already exists with empty CPT/tax registration but already referenced post types, ACF fields, widgets, and schema helpers. I filled that gap instead of replacing the theme or building the front-end

---

## Code organization

**Config array + registration loop** (`post-types-config.php`, `cpt/register.php`, `tax/register.php`)

I register CPTs and taxonomies from a single config file. Adding a type means one array entry, not duplicated `register_post_type()` blocks. Taxonomies stay declared next to the CPT they belong to.

Slugs follow what the skeleton already expects (`team`, `practice-area`, etc.) so widgets and schema code work without rewrites.

---

## Custom post types

### `practice-area`

Primary SEO/conversion pages for a PI firm. Hierarchical so parent/child areas work (e.g. Personal Injury → Car Accidents). Supports rich content, FAQs, and testimonial links. Wired to practice-area schema and sidebar widgets.

### `team`

Attorney profiles as standalone content (bio, role, photo, practice links). Slug `team` matches the skeleton; rewrite `/attorney/` for public URLs. `author` support links a profile to a WP user when they also write posts.

### `local`

Local SEO needs both geo landing pages and physical offices. One CPT keeps that separate from blog posts and practice areas. Hierarchical for state → city structure.

**`content_type` (ACF)** splits Area Served vs Office Location — office schema runs only on the latter.

### `testimonials`

Reviews are reused across practice areas and feed aggregate schema. A CPT with an archive scales better than storing reviews in page meta. Name and rating live in ACF for structured output.

---

## Taxonomies

| Taxonomy | Why |
|----------|-----|
| `practice-category` | Group practice areas by line of work |
| `attorney-department` | Filter attorneys by department |
| `area-served` | Shared between `local` and `practice-area` for region-based queries |
| `testimonial-source` | Filter by origin (Google, Avvo, etc.) |
| `event-type` on `post` | Tag seminars/webinars without a dedicated event CPT |

CPT-bound taxonomies live in `post-types-config.php`. Cross-CPT ones (`area-served`, `event-type`) register in `tax/register.php`.

---

## ACF vs native fields

Core `supports` (`title`, `editor`, `thumbnail`, `page-attributes`) handle editorial content. ACF handles firm-specific data: contacts, geopoints, relationships, grouped FAQ slots, event dates. They complement each other — ACF extends posts, it doesn't replace the editor.

Field groups use **ACF free** types only. Repeater fields were avoided because they require ACF PRO; social URLs use a fixed **group**, FAQs use three nested **group** slots, and offices come from the **`local` CPT** instead of an options repeater.

Field groups sync via `acf-json/` and `inc/acf.php` so fields travel with the theme across environments.

---

## Simplifications

**No separate `office` CPT** — address and geo data duplicated what `local` already covered. One field (`content_type = Office Location`) triggers office schema in `hooks.php`.

**No event CPT** — low volume; `post` + `event-type` + ACF date/location fields is enough and keeps the pattern for news and events.

---

## Plugins

| Plugin | Why |
|--------|-----|
| ACF (free) | Field groups and options pages — no PRO/Repeater |
| Yoast SEO | Theme already hooks breadcrumbs and meta |
| Classic Editor | Stable editing workflow I use in production |
| Contact Form 7 | Shortcode forms; lighter than Gravity Forms for this scope |

Skipped Gravity Forms and Max Mega Menu — skeleton references them but native menus and no forms are enough here. See [plugin-decisions.md](plugin-decisions.md).

---

## Schema

JSON-LD comes from theme code (`inc/utils/seo/schema.php`), not a plugin. Demo content validates that ACF data reaches firm, office, practice-area, and FAQ markup correctly.

---

## Seed script

`scripts/seed-demo-content.php` loads sample content, menus, and widgets for local testing. Idempotent — safe to re-run.

---

## Out of scope

Front-page layout, Gravity Forms / Mega Menu wiring, custom per-CPT templates, visual parity with reference firm sites.
