## Getting Started

We've tried to make it _super easy_ to get up and running on this [challenge](https://github.com/MeanPug/meanpug-wordpress-developer-challenge). Simply `cd` to the directory, and run the `docker compose up -d` to bring up a fully functional Wordpress environment at `localhost:8000`, complete with a Gulp build system and Tailwind + PostCSS CSS integration.

### Custom plugin: `pug-puggle-schema`

The `./plugins/` folder is bind-mounted into `wp-content/plugins`, and `plugins/*` is gitignored (so license keys never get committed).

To re-run the provisioning script after dropping a new zip:

```
docker compose run --rm wpcli
```

Custom post types and taxonomies (Practice Areas, Attorneys, Testimonials, Offices, Areas Served, Case Results, FAQs and their taxonomies) live in [`plugins/pug-puggle-schema/`](plugins/pug-puggle-schema/), with the main plugin file at [`plugins/pug-puggle-schema/pug-puggle-schema.php`](plugins/pug-puggle-schema/pug-puggle-schema.php).

This is intentional: **content schema belongs in plugins, not themes**. If the theme is swapped out, the data and post types persist. The plugin is auto-activated by `init.sh` on first boot.

## The Project

Welcome to the Law Firm of Pug and Puggle, ESQ. In this challenge, you'll be implementing the backend for a law firm's website.
What are some things you'll want to include on a firm's site? Looking at the websites of [Morgan and Morgan](https://www.forthepeople.com/) and [Milberg](https://www.milberg.com) would be a great starting point!
