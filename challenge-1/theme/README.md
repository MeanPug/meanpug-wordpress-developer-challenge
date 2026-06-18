# AirPnP — Challenge 1 (Pugify that site)

A WordPress front page replicating the **Airbnb** home-page aesthetic for
*airPnP — a MeanPug joint*, with the required MeanPug pug on the page.

## 👀 How to see it (multiple ways)

| | Where |
| --- | --- |
| 🔴 **Live demo (front-end)** | **https://dev.glitchwood.com/airpnp/** |
| 🔑 **Admin (read the build in wp-admin)** | `https://dev.glitchwood.com/airpnp/wp-admin/` — reviewer login: _provided in the PR description_ |
| 💾 **Full importable backup** | [Download (TransferNow)](https://www.transfernow.net/dl/luiscastillo-meanpug-challenge) — full UpdraftPlus backup (DB + uploads + theme) for a 1:1 local copy |

> The home layout and media are **block content in the database / Media Library**
> (not a hardcoded template), so the live site is the canonical reference. This
> repo ships the **theme** (engine, blocks, FSE templates, styles). A fresh Docker
> install will show an empty site until that content is imported. This copy mirrors
> the **deployed (online) theme**, so its asset URLs point at the live site.

### Reproduce it locally (optional, for a full 1:1 copy)
The full site (home page content + Media Library + theme) is provided as an
**UpdraftPlus** backup so you can restore the exact site, not just the theme:

1. On a fresh WordPress install, install & activate the free **[UpdraftPlus](https://wordpress.org/plugins/updraftplus/)** plugin.
2. Download the backup set from the link above and unzip it (you'll get
   `*-db.gz`, `*-uploads.zip`, `*-themes.zip`, `*-plugins.zip`, `*-others.zip`).
3. Go to **Settings → UpdraftPlus Backups → Upload backup files** and add those files.
4. Click **Restore**, select all components, and follow the prompts.

> Prefer not to restore anything? Just open the **live demo** — it shows the finished result.

---

## Built 100% from scratch — no builders, no plugins

This theme is **not** assembled with a page builder and requires **no third-party
WordPress plugins** for its structure:

- ❌ No Elementor, Divi, WPBakery, Beaver Builder, Bricks, etc.
- ❌ No ACF / no "blocks plugin" / no premium plugin dependencies.
- ✅ **Native WordPress Full Site Editing (FSE) block theme** — the whole design
  system is driven by `theme.json` (color, spacing, typography presets), with FSE
  templates (`templates/`) and template parts (`parts/`).
- ✅ **In-house block engine** for everything custom (below).

Front-end micro-libraries (Swiper, Magnific Popup, a Bootstrap grid stylesheet,
jQuery) are **vendored under `assets/lib/`** for specific UI affordances — these
are libraries, not page builders or plugins.

## The custom block engine — "GW Custom Blocks"

All the interactive Airbnb-style UI is delivered through **our own** block engine,
written from scratch:

- **`gw/gw-core/gw-custom-blocks/`** — `GW Custom Blocks`, authored in-house and
  distributed via the open-source **gw-core** engine
  ([github.com/LuigiLibet/gw-core](https://github.com/LuigiLibet/gw-core)).
- A single helper, **`gw_register_block()`**, registers **dynamic, server-rendered
  (PHP) blocks** with: render-template auto-discovery, **auto-generated inspector
  controls** from a `fields` array, and native `supports` (anchor, color, spacing…).
- Theme blocks are wired declaratively in **`inc/theme-blocks.php`** and rendered
  from each block's **`blocks/<name>/view.php`**.

### Theme blocks (`blocks/`) — the Airbnb UI
| Block | Purpose |
| --- | --- |
| `search-bar` | Airbnb-style location / dates / guests search field |
| `menu-trigger` | Menu / hamburger toggle |
| `account-menu` | User account dropdown in the header |
| `icon-chip` | Round icon button (globe / language, etc.) |
| `tabs` / `tab` | Tabbed category navigation |

### Reusable engine blocks (`gw/gw-core/included-blocks/`)
Shipped with the engine and used across the design: `navigation-menu`, `slider`,
`slide`, `share-icons`, `link-wrapper`, `footer-text`, `meta-tag`,
`all-settings-check`.

## Project structure
```
challenge-1/theme/
├── theme.json            # design tokens + FSE settings (drives the whole look)
├── style.css             # minimal (block theme); styling lives in theme.json
├── functions.php         # bootstraps the GW engine + theme supports + assets
├── gw/                   # GW Custom Blocks engine (in-house): core, engine, updater
│   └── gw-core/
│       ├── gw-custom-blocks/   # the registration engine + inspector controls
│       └── included-blocks/    # reusable engine blocks
├── blocks/               # theme's custom server-rendered blocks (view.php each)
├── inc/
│   ├── theme-blocks.php   # gw_register_block() calls + block styles/categories
│   └── helpers.php
├── parts/                # FSE template parts (header.html, footer.html)
├── templates/            # FSE templates (index, archive, single, page, search, 404)
└── assets/
    ├── css/main.css       # compiled styles (pre-built — no build step needed)
    ├── js/main.js
    └── lib/               # vendored Swiper / Magnific Popup / Bootstrap grid
```

## Requirements & running
- WordPress 6.0+, PHP 8.0+ (FSE block theme).
- **No build step required** — `assets/css/main.css` / `assets/js/main.js` are committed pre-built.
- Docker (challenge env): `cd challenge-1 && docker compose up -d`; theme mounts as
  `challenge-1-theme`. Activate under *Appearance → Themes*, then import the content
  backup (or just use the live demo above).

## Challenge requirement check
- ✅ Airbnb front-page aesthetic replicated (header, search bar, hero, listing cards).
- ✅ A **MeanPug pug** is present on the page (`meanpug-pug` image + pug-themed copy).
