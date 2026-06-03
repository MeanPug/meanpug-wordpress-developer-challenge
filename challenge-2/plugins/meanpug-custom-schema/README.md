# MeanPug Custom Schema

Custom plugin for the Law Firm of Pug and Puggle, ESQ. Registers custom post types, taxonomies, meta boxes, a custom database table, and REST API endpoints.

## Requirements

- WordPress 6.0+
- PHP 8.0+

## Installation

1. Copy the `meanpug-custom-schema` folder into `wp-content/plugins/`.
2. Log in to the WordPress admin panel.
3. Go to Plugins and activate MeanPug Custom Schema.

## Custom Post Types

- **attorney** — Firm members with bio, credentials, and contact info. Accessible at `/attorneys/`.
- **practice_area** — Legal service areas offered by the firm. Accessible at `/practice-areas/`.
- **case_result** — Won cases with verdict amounts and details. Accessible at `/case-results/`.

## Custom Taxonomies

- **practice_area_type** — Hierarchical. Broad legal categories with sub-specialties. Connects to `practice_area`, `attorney`, and `case_result`.
- **state_bar** — Non-hierarchical. US states where attorneys are licensed. Connects to `attorney`.

## Custom Database Table

Table `wp_case_inquiries` stores potential client contact form submissions with fields: `full_name`, `email`, `phone`, `practice_area_id`, `message`, `status`, and `submitted_at`.

## REST API Endpoints

Base namespace: `/wp-json/meanpug/v1/`

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/attorneys` | Returns all published attorneys with meta and taxonomy data |
| GET | `/practice-areas` | Returns all published practice areas with meta data |
| GET | `/case-results` | Returns all published case results, filterable by `practice_area_type` slug |

### Example