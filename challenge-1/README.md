# Challenge 1 — AirPnP

WordPress front page replicating the Airbnb above-the-fold layout. The MeanPug
pug lives in the user-pill avatar at the top-right of the nav.

## Run it

```bash
cd challenge-1
docker compose up -d --build
```

Open <http://localhost:8000>. The site boots fully populated from the
committed `airpnp-seed.sql` — no install wizard, no manual steps.

Admin login: `admin` / `password` at <http://localhost:8000/wp-admin>.

## What the boot does

`docker/wordpress/entrypoint-airpnp.sh` waits for MySQL, imports
`airpnp-seed.sql` if the DB is empty, and writes a marker file at
`wp/.airpnp-seeded` so subsequent restarts skip the import. The
Advanced Custom Fields plugin is baked into the wordpress image
(the upstream theme scaffolding calls `get_field()` in the wp_footer
hook); the entrypoint also activates it defensively if missing.

## Re-seed

```bash
docker compose down -v
rm -f wp/.airpnp-seeded
docker compose up -d --build
```

Drops volumes and the marker; the entrypoint re-imports the seed on
next boot.

## Build pipeline

The `static` container runs `npm run dev`, watching the theme sources and
rebuilding `theme/{critical,main,front-page}.{js,css}` on save. For a
one-off production build:

```bash
docker compose exec static npm run build
```

## Notable implementation choices

- **Front-page-only asset enqueue** — `Airpnp\Assets::enqueue()` gates the
  front-page CSS/JS on `is_front_page()`, so admin and other pages don't
  pay the cost.
- **Custom Gutenberg block** `airpnp/listing-cards` lives in
  `theme/blocks/listing-cards/`, server-rendered via `render.php`. The
  editor UI is built without JSX so it compiles with the existing Babel
  preset.
- **Transient-cached `WP_Query`** for the homepage listing cards
  (`airpnp_front_cards`, 1h TTL, busted on `save_post` / `deleted_post` /
  `trashed_post` / `untrashed_post`). Query uses `no_found_rows`,
  `fields => 'ids'`, and disables meta/term cache priming.
- **Namespaced OOP classes** under `theme/inc/classes/` — `Airpnp\Front_Page`,
  `Airpnp\Assets`, `Airpnp\Seo`, `Airpnp\Patterns`. Existing procedural code
  in `functions.php` is left alone.
- **Accessibility** — skip-to-content link, landmark roles, ARIA on icon
  buttons and dropdowns, keyboard nav with Escape support, `role="status"`
  toast announcements, `prefers-reduced-motion` respected.
- **SEO** — meta description, canonical, Open Graph, and Twitter card
  tags emitted on the front page only.
- **i18n-ready** — every visible string wrapped in `__()` / `_e()` against
  the `inf` text domain; JS strings exposed via `wp_localize_script` as
  `window.AIRPNP_I18N`.
