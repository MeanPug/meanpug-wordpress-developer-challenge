## Getting Started
We've tried to make it _super easy_ to get up and running on this [challenge](https://github.com/MeanPug/meanpug-wordpress-developer-challenge). Simply `cd` to the directory, and run the `docker compose up -d` to bring up a fully functional Wordpress environment at `localhost:8000`, complete with a Gulp build system and Tailwind + PostCSS CSS integration.

## The Project
Welcome to the Law Firm of Pug and Puggle, ESQ. In this challenge, you'll be implementing the backend for a law firm's website.
What are some things you'll want to include on a firm's site? Looking at the websites of [Morgan and Morgan](https://www.forthepeople.com/) and [Milberg](https://www.milberg.com) would be a great starting point! 


# Pug & Puggle Law Firm – Backend Schema

This project contains the complete **content schema** for the Pug & Puggle, ESQ. website.  
It registers custom post types, taxonomies, and post meta directly inside the theme, making the backend ready for front‑end development **without depending on any third‑party plugin** (ACF, etc.).

The schema is built according to the [Challenge 2 specifications], following real‑world law firm patterns.

---

## 🚀 Quick Start (Local Environment)

1. **Clone the repository**
   ```bash
   git clone <repo-url> pug-puggle-law
   cd pug-puggle-law/challenge-2
   ```

2. **Start Docker containers**
   ```bash
   docker compose up -d
   ```
   WordPress will be available at `http://localhost:8080`.  
   The database is created automatically (`pugpuggle`).

3. **Activate the theme**
   - Log in to the WordPress admin (`/wp-admin`).
   - Go to **Appearance → Themes** and activate **Pug & Puggle**.
   - (If using WP‑CLI: `wp theme activate pug-puggle`)

4. **Permalinks**
   - Navigate to **Settings → Permalinks** and choose **Post name**.
   - Save changes to flush rewrite rules.

Now the schema is fully active.

---

## 📂 Theme Structure

All custom functionality lives inside `theme/inc/`.  
Each concern is separated into its own directory with an `all.php` loader, making it easy to disable or extend individual features.

```
theme/
├── style.css                     # Theme header
├── front-page.php                # Developer‑facing schema overview
├── functions.php                 # Master loader
└── inc/
    ├── cpt/
    │   ├── all.php
    │   ├── attorney.php
    │   ├── practice-area.php
    │   ├── case-result.php
    │   ├── testimonial.php
    │   ├── office.php
    │   └── faq.php
    ├── tax/
    │   ├── all.php
    │   ├── practice-area-group.php
    │   ├── case-type.php
    │   ├── region.php
    │   └── attorney-position.php
    ├── meta/
    │   ├── all.php
    │   ├── attorney.php
    │   ├── practice-area.php
    │   ├── case-result.php
    │   ├── testimonial.php
    │   ├── office.php
    │   └── faq.php
    ├── rest/
    │   ├── all.php
    │   └── fields.php
    └── plugins/
        └── all.php
```

---

## 🧱 Custom Post Types (6)

All post types are registered on `init` and are publicly queryable with REST API support (`show_in_rest = true`).

| Slug            | Hierarchical | Purpose                                      |
|-----------------|--------------|----------------------------------------------|
| `attorney`      | No           | Attorney profiles                            |
| `practice_area` | Yes          | Areas of law (can have parent/child pages)   |
| `case_result`   | No           | Verdicts and settlements                     |
| `testimonial`   | No           | Client testimonials (drives Review schema)   |
| `office`        | No           | Physical office locations (LocalBusiness)    |
| `faq`           | No           | Frequently asked questions (FAQPage schema)  |

**Where to see them:**  
- WordPress admin sidebar will show each post type after theme activation.
- Navigate to any CPT to add or edit entries.

---

## 🏷️ Taxonomies (4)

| Slug                 | Attached post types        | Hierarchical | Description                           |
|----------------------|----------------------------|--------------|---------------------------------------|
| `practice-area-group`| `practice_area`           | Yes          | Cross‑cutting grouping of practice areas |
| `case-type`          | `case_result`, `practice_area` | No       | Type of case (e.g., “Class Action”)   |
| `region`             | `office`, `practice_area` | Yes          | Geographic region / office location   |
| `attorney-position`  | `attorney`                | No           | Role (Partner, Associate, etc.)       |

All taxonomies appear under their respective post types in the admin menu.  
Column visibility is enabled (`show_admin_column = true`) for quick editing.

---

## 🗂️ Post Meta & Meta Boxes

Every CPT has a **native meta box** for editing high‑traffic fields.  
All fields are registered with `register_post_meta` (single, typed) and exposed in the REST API.

### **Attorney**
- `position` (string)
- `bar_admissions` (array of strings)

### **Practice Area**
- `icon` (integer – media attachment ID)
- `short_description` (string)

### **Case Result**
- `verdict_amount` (integer – value in **cents**)
- `case_summary` (string)

### **Testimonial**
- `client_name` (string)
- `rating` (number – e.g., 4.5)

### **Office**
- `address` (string)
- `phone` (string)
- `city` (string)

### **FAQ**
- `faq_answer` (long string)

**Testing the meta:**  
1. Edit any post of these types.  
2. You will see the custom meta box with the fields listed above.  
3. Fill in values and save — the data persists and is immediately available via REST.

---

## 🔗 REST API Enrichment

Additional fields are registered on the REST API to ease front‑end consumption.

- **`related`** (on `attorney`, `practice_area`, `case_result`)  
  Returns an array of minimal post objects (ID, title, slug) based on a stored list of related post IDs.

- **`amount_formatted`** (on `case_result`)  
  Converts the `verdict_amount` (stored in cents) to a human‑readable dollar string (e.g., `$12,500,000.00`).

**How to verify:**  
- Open `/wp-json/wp/v2/case_result` or any single post endpoint.  
- You will see both the raw meta fields and the `related` / `amount_formatted` fields.

---

## 🧩 Recommended Plugins

The theme **checks for essential plugins** and displays a dismissible admin notice if any are missing.

The recommended plugins (all free) are:

- **Advanced Custom Fields (ACF)** – for building richer custom field interfaces (if needed later).
- **Contact Form 7** – free contact form builder.
- **Yoast SEO** – meta tags, sitemaps, readability analysis.
- **Redirection** – 301 redirects and 404 error tracking.
- **WP Super Cache** – static page caching for speed.
- **Wordfence Security** – firewall, malware scanning, login protection.
- **UpdraftPlus Backup** – scheduled backups to remote storage.

No plugin code is bundled; the theme only encourages their installation.  
**The entire schema works without any of them.**

**To trigger the notice:**  
- Go to the **Plugins** page and deactivate one of the recommended plugins.  
- The warning will appear at the top of any admin screen.

---

## 🧪 Testing the Full Setup

After activating the theme and flushing permalinks:

1. **Check admin menus**  
   You should see all six CPTs in the left sidebar.

2. **Check taxonomies**  
   Under each CPT menu, the corresponding taxonomies appear (e.g., “Attorney Positions” under Attorneys).

3. **Create test content**  
   Add a few entries in each post type, filling in the meta boxes.  
   Verify the data saves correctly.

4. **Inspect REST API**  
   - Visit `/wp-json/wp/v2/` to see all registered routes.  
   - Retrieve specific posts: `/wp-json/wp/v2/attorney`  
   - Confirm `related` and `amount_formatted` fields are present where expected.

5. **View the Schema Overview**  
   Set your homepage to display a static page that uses the `front-page.php` template (or simply visit the homepage if the theme is active).  
   You’ll see a clean grid listing every CPT and taxonomy with direct **Admin** and **REST** links.

6. **Plugins notice**  
   Temporarily deactivate one of the recommended plugins and observe the admin notice.

---

## 📝 Development Notes

- The schema is **theme‑based**, not a plugin – keeping it alongside the front‑end codebase simplifies version control.
- CPTS and taxonomies are loaded via `all.php` loaders – you can easily comment out any line to disable a specific entity.
- The REST enrichments are legacy‑tolerant (they don’t fail on missing meta values).
- This backend is ready for a front‑end team to start building templates using `WP_Query` or the REST API immediately.

---

## 🔒 Security & Hardening

The theme does **not** modify WordPress core behavior.  
For production, we recommend:

- Setting `DISALLOW_FILE_EDIT` to `true` in `wp-config.php`.
- Keeping all recommended security plugins active.
- Regularly updating WordPress core, themes, and plugins.

---

## 📄 License

This project is part of the MeanPug demonstration challenges.  
It may be freely used for learning and internal testing.
```