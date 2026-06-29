# Plugin stack — Law Firm of Pug and Puggle

## Installed

- **Advanced Custom Fields (free)** — custom fields, options pages (`theme-general-settings`, `theme-shared-settings`), and JSON sync via `theme/acf-json/`. Field groups use only free ACF types (Group, Relationship, Link, etc.). **Repeater is not used** — it requires ACF PRO in current versions.
- **Yoast SEO** — breadcrumbs (`[wpseo_breadcrumb]` in templates), meta descriptions used by practice-area schema
- **Classic Editor** — admin editing preference; consistent with the MeanPug skeleton

## ACF field choices (no PRO)

| Need | Solution |
|------|----------|
| Multiple social URLs | **Group** with fixed URL fields (Facebook, LinkedIn, Twitter) |
| FAQ schema on practice areas | **Group** with three FAQ slots (`faq_1`–`faq_3`), each a nested group (question + answer) |
| Office list in location navigator | **`local` CPT** where `content_type = Office Location` — not a options repeater |

## Not used

- **ACF PRO** — Repeater, Flexible Content, and Clone are paid fields; avoided so the project runs on ACF free only.
- **Gravity Forms** 
- **Max Mega Menu** 

## Local dev

- `scripts/seed-demo-content.php` — optional; populates theme options and sample CPT posts for local validation
