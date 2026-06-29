# Challenge 2 — Law Firm of Pug and Puggle

Backend content model and schema implementation for a fictional personal-injury law firm, built on the MeanPug WordPress skeleton.

---

## Getting started

From the `challenge-2/` directory:

```bash
docker compose up -d
```

Site: **http://localhost:8000**

### 1. WordPress install

Open http://localhost:8000 and complete the installation wizard (site title, admin user, password).

### 2. Plugins

Install and activate via **Plugins → Add New**:

| Plugin | Slug |
|--------|------|
| Advanced Custom Fields | `advanced-custom-fields` |
| Yoast SEO | `wordpress-seo` |
| Classic Editor | `classic-editor` |

Field groups ship with the theme in `theme/acf-json/` and load automatically once ACF and the theme are active. Only **ACF free** field types are used (no Repeater — that requires ACF PRO). See [plugin-decisions.md](plugin-decisions.md).

### 3. Theme

**Appearance → Themes** → activate **infra** (`challenge-2-theme`).

### 4. Permalinks

**Settings → Permalinks** → select **Post name** → Save.

CPT URLs (`/practice-area/...`, `/attorney/...`, etc.) require this step.

### 5. Theme assets

```bash
docker compose exec static npm run build-js
```

Generates `critical.css`, `critical.js`, `main.css`, and `main.js` in the theme root. Without this step, the front-end may show `filemtime()` warnings.

### 6. Theme settings (ACF options)

**MeanPug Theme Settings** in the admin sidebar:

| Field | Value |
|-------|-------|
| Contact phone | `1-800-PUG-LAW` → `tel:+1800784529` |
| Contact email | `contact@pugandpuggle.com` |
| Main address | 123 Puggle Plaza, Orlando, FL 32801 |
| Social profiles | Facebook, LinkedIn, Twitter URLs (separate fields under **Social Profiles**) |
| Aggregate rating | 4.9 / 127 reviews |

The header phone link reads from **Contact phone**.

### 7. Demo content

**Option A — seed script (recommended)**

After steps 1–4 (especially **theme activated** and **permalinks saved**):

```bash
cat scripts/seed-demo-content.php | docker compose exec -T wordpress bash -c "cat > /tmp/seed-demo-content.php && php /tmp/seed-demo-content.php"
```

The script is idempotent (safe to re-run). It creates taxonomy terms, sample CPT posts, theme options, main menu, and the Related Practice Areas widget.

If you see `Invalid taxonomy`, the theme was not active yet — activate **infra** in wp-admin and run the seed again.

**Option B — manual (wp-admin)**

#### Taxonomy terms

| Taxonomy | Terms |
|----------|-------|
| Practice Categories | Personal Injury, Medical Malpractice |
| Attorney Departments | Partners, Litigation |
| Areas Served | Florida |
| Testimonial Sources | Google Reviews, Avvo, Facebook |
| Event Types | Seminar |

#### Practice Areas

| Title | Practice Category | Area Served |
|-------|-------------------|-------------|
| Car Accidents | Personal Injury | Florida |

On **Car Accidents**, fill **Schema FAQ Items** (`schema_faq_items`) — up to three question/answer pairs (FAQ 1–3) — to trigger `FAQPage` JSON-LD.

#### Testimonials

| Title | Reviewer name | Rating | Source |
|-------|---------------|--------|--------|
| John D. | John D. | 5 | Google Reviews |

On **Car Accidents**, relate the testimonial via the **Testimonials** relationship field.

#### Locals (hierarchical)

| Title | Parent | Content type | Area type | Notes |
|-------|--------|--------------|-----------|-------|
| Tampa Office | — | Office Location | City | Address: 456 Bayshore Blvd, Suite 200, Tampa FL 33602; phone; geopoint |

**Tampa Office** must use `content_type = Office Location` — this drives office-specific `LocalBusiness` schema on the single.

#### Attorneys

| Title | Role | Department | Practice areas |
|-------|------|------------|----------------|
| Pug Esq. | Managing Partner | Partners | Car Accidents |

Public URL: `/attorney/{slug}/` (e.g. `/attorney/pug-esq/`).

#### Post (event)

| Title | Event type | Event date | Event location |
|-------|------------|------------|----------------|
| Community Seminar | Seminar | 2026-09-15 | Orlando Convention Center |

#### Page

| Title | Slug |
|-------|------|
| Contact | `contact` |

### 8. Navigation

**Appearance → Menus** → create **Main Menu** with links to:

- Practice Areas archive
- Attorneys archive
- Testimonials archive
- Contact page

Assign to theme locations: **Nav**, **Mobile Nav**, **Footer**.

### 9. Sidebar widget

**Appearance → Widgets** → **Default Sidebar** → add **Related Practice Areas**.

Shows sibling practice areas on practice-area singles.

### 10. Quick validation

| URL | What to check |
|-----|---------------|
| `/` | Header shows phone from theme settings |
| `/practice-area/car-accidents/` | Content, FAQ schema in page source (`FAQPage`) |
| `/attorney/pug-esq/` | Attorney profile |
| `/local/tampa-office/` | Office schema in page source (`LocalBusiness`) |
| `/testimonials/` | Testimonials archive |

View page source and search for `application/ld+json` to confirm schema output.

---

## Content model

### CPTs (4)

| CPT | Slug | Purpose |
|-----|------|---------|
| Practice Areas | `practice-area` | Hierarchical areas of law; SEO landing pages with FAQ and testimonial relationships |
| Attorneys | `team` | Attorney profiles; public rewrite `/attorney/{slug}/` |
| Locals | `local` | Geographic content; `content_type` distinguishes **Area Served** vs **Office Location** |
| Testimonials | `testimonials` | Client reviews with reviewer name, rating, and source taxonomy |

Events use the native `post` type with the `event-type` taxonomy (no separate event CPT).

### Taxonomies

| Taxonomy | Attached to | Purpose |
|----------|-------------|---------|
| `practice-category` | `practice-area` | Group practice areas (e.g. Personal Injury, Medical Malpractice) |
| `attorney-department` | `team` | Firm departments (Partners, Litigation) |
| `area-served` | `local`, `practice-area` | Geographic service areas |
| `testimonial-source` | `testimonials` | Review origin (Google Reviews, Avvo, etc.) |
| `event-type` | `post` | Event classification (Seminar, Webinar) |

### Architectural decisions

- **Merged `office` into `local`** — A single CPT with `content_type: Office Location` avoids redundant post types while still supporting office-specific schema (`LocalBusiness` on office singles).
- **Events as `post` + `event-type`** — Native posts with ACF `event_date` / `event_location` fields replace a dedicated `firm-event` CPT.
- **Config-driven registration** — CPTs and taxonomies are declared in `theme/inc/cpt/post-types-config.php` and registered via `register.php` loops.

## Plugins

| Plugin | Role |
|--------|------|
| **Advanced Custom Fields** | Field groups, options pages, JSON sync (`theme/acf-json/`) |
| **Yoast SEO** | Breadcrumbs (`[wpseo_breadcrumb]`), meta descriptions for practice-area schema |
| **Classic Editor** | Admin editing preference |

See [docs/plugin-decisions.md](docs/plugin-decisions.md) for plugins not used (Gravity Forms, Max Mega Menu).

## ACF

- **Options** (`theme-general-settings`, `theme-shared-settings`): contact phone/email/address, social profiles, aggregate rating for schema
- **Per-CPT fields** in `theme/acf-json/`:
  - Practice area: testimonials relationship, FAQ group (3 slots), related attorneys
  - Team: role, email, phone, practice areas relationship
  - Local: content type, area type, geopoint, address, phone, hours
  - Testimonial: reviewer group, rating
  - Post (events): event date, event location

## Schema (JSON-LD)

Output via `theme/inc/hooks.php` and `theme/inc/utils/seo/schema.php`:

| Context | Schema types |
|---------|--------------|
| All pages | `LocalBusiness` (global firm info from options) |
| Office local single (`content_type = Office Location`) | `LocalBusiness` with office address/geo |
| Practice area single | `Product` + `Review` (linked testimonials) |
| Practice area with FAQ group | `FAQPage` |
| Testimonials archive | Aggregate `Review` markup |

## Skeleton integrations

- **Related Practice Areas widget** — `theme/inc/widgets/practice-areas.php`; shows sibling practice areas on singles
- **Location Navigator widget** — `theme/inc/widgets/shared/location-navigator.php`; AJAX search via `theme/inc/services/locations.php` (filters `local` where `content_type = Area Served`); office carousel uses `local` posts with `content_type = Office Location`
- **Header** — Phone from ACF options; menus assigned to Nav, Mobile Nav, Footer

## Further reading

- [docs/content-model-rationale.md](docs/content-model-rationale.md) — why each piece exists
- [docs/plugin-decisions.md](docs/plugin-decisions.md) — plugin choices