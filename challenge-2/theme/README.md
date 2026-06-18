# Table of Contents

1. [Installation and Configuration](#installation-and-configuration)
2. [Known issues](#known-issues)
3. [Parent theme](#parent-theme)
4. [Compiling static assets](#compiling-assets)
5. [Troubleshooting Common Issues](#troubleshooting-issues)

## [Installation and Configuration](#installation-and-configuration)

* Search/Ask for a `<NPM_TOKEN>` and `<COMPOSER_TOKEN>` which should be provided for each project individually
* Create a `.npmrc.dev` file at the root of the project and populate it 
```sh 
    //registry.npmjs.org/:_authToken=<NPM_TOKEN>
```
* Run the following command to build images:
```sh
    docker-compose build --build-arg COMPOSER_USERNAME=token --build-arg COMPOSER_TOKEN=<COMPOSER_TOKEN>
```
* Once the images are built, run the services with:
```sh
    docker-compose up -d
```

## [Known issues](#known-issues)

* On Windows environment, line endings need to be set to LF instead of CRLF in `install-composer.sh` file

> If you encounter some error during this process, please report it to your project manager.

## [Parent Theme Docs](#parent-theme)
The MeanPug Legal PI Parent Theme is intended as a way to:

* Standardize the content model across Personal Injury Law Firm clients
* Abstract common/core blocks into a shared location

Reference the [Parent Theme Documentation](https://github.com/MeanPug/meanpug-legal-pi-parent-theme) for information on the content types, core blocks, and
JS libraries that ship, as well as general information on our guidelines for Wordpress Development and other DX topics.


## [Compiling Static Assets](#compiling-assets)
All our assets (js/css) are compiled inside a docker static container, so when you run `docker-compose up -d`, 
all the changes you make are immediately compiled. Please check webpack configuration for entry points.

## [Core Plugins](#core-plugins)
Until we move to a more mature package dependency manager for the development pipeline (like composer), this section will 
serve as a guide of the plugins we use for common tasks in development/prod.

* **Custom Fields - [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/pro/) — REQUIRED.** The theme depends
  on `get_field()` throughout (CPT data, options, schema). Field groups are version-controlled as JSON in `acf-json/` and
  load automatically; ACF Pro is required because several groups use the Repeater and Google Map field types.
* Menus - [Max Mega Menu](https://wordpress.org/plugins/megamenu/)
* Forms - [Gravity Forms](https://docs.gravityforms.com/installation/)
* SEO - [Yoast](https://yoast.com/)

## [Content Model / Schema](#content-model)
The theme ships templates, services and widgets that expect a specific content model. It is registered in
`inc/cpt/` (one file per post type, indexed by `inc/cpt/all.php`), `inc/tax/` and `acf-json/`.

### Custom Post Types (`inc/cpt/`)
| Slug | Label | Notes |
| --- | --- | --- |
| `practice-area` | Practice Areas | Hierarchical; uses `category` taxonomy + page-attributes ordering. Consumed by the Related Practice Areas widget and Product schema. |
| `testimonials` | Testimonials | Has archive; emits Review/Product schema. |
| `local` | Locations (Areas Served) | Hierarchical. Queried by `content_type = "Area Served"` + ACF `geopoint` ({lat,lng}) in `inc/services/locations.php`. |
| `team` | Attorneys | **Slug is `team`, not `attorney`** — see decisions below. |
| `office` | Offices | Physical locations; `mp_generate_office_schema()` reads ACF `address` + `geopoint`. |
| `case-result` | Verdicts & Settlements | Own-initiative; amount, case type, year, attorney + practice areas. |

### Taxonomies (`inc/tax/`)
| Slug | Attached to | Notes |
| --- | --- | --- |
| `area-served` | `local`, `office`, `practice-area` | Hierarchical geographic taxonomy referenced by the location services. |

### ACF Field Groups (`acf-json/`)
`group_inf_location`, `group_inf_office`, `group_inf_testimonial`, `group_inf_attorney`, `group_inf_case_result`,
`group_inf_global_settings` (Theme Settings options page) and `group_inf_user_profile` (`team_profile` user link).
Field names and shapes mirror exactly what the theme already reads (verified against `inc/services/locations.php`,
`inc/utils/seo/schema.php`, `inc/modules/location-navigator/` and the widgets).

### Schema design decisions
* **Attorney CPT is `team`, not `attorney`.** The theme already references `team` (`inc/utils/posts.php` maps
  `'team' => 'Attorney'`, `single.php` wires `attorney-sidebar`/`attorney-header`, `practice-areas.php` checks
  `is_singular('team')`). Honouring the existing slug beats introducing a parallel `attorney` type.
* **`office` is a first-class CPT.** It is not in the original brief but the SEO schema layer
  (`is_singular('office')` → `mp_generate_office_schema()`) requires it.
* **Practice-area relationships use an ACF Relationship field (`practice_areas`), not a new taxonomy.** The theme
  consumes `get_field('practice_areas', ...)` on posts, attorneys and locations, so a `practice-area-category`
  taxonomy was intentionally not created.
* **Two distinct address shapes are intentional.** `office.address` uses `street/street2/city/state/postal_code`
  while the global `contact_main_address` uses `street_number/street_name/city/state/post_code/lat/lng` — each matches
  the exact keys read in `inc/utils/seo/schema.php`.

## [Troubleshooting Common Issues](#troubleshooting-issues)
### Table of Contents (LWP_ToC) block is not showing up with shortcode usage
For some reason, when an excerpt isn't set for the current post/page, the LWP_ToC shortcode fails to render a ToC. It
works just fine in widget form, only in shortcode form does it fail. Additionally, disabling Yoast SEO fixes the issue.
Short answer: Include an excerpt on all posts/pages that require a ToC.
