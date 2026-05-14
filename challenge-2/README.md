## Getting Started
We've tried to make it _super easy_ to get up and running on this [challenge](https://github.com/MeanPug/meanpug-wordpress-developer-challenge). Simply `cd` to the directory, and run the `docker compose up -d` to bring up a fully functional Wordpress environment at `localhost:8000`, complete with a Gulp build system and Tailwind + PostCSS CSS integration.

## The Project
Welcome to the Law Firm of Pug and Puggle, ESQ. In this challenge, you'll be implementing the backend for a law firm's website.
What are some things you'll want to include on a firm's site? Looking at the websites of [Morgan and Morgan](https://www.forthepeople.com/) and [Milberg](https://www.milberg.com) would be a great starting point! 

# Directory Implementation

## Objective
Establish a relational data architecture in WordPress to manage legal services and specialists.

## Backend Focus
The focus was on delivering a **pragmatic solution without overengineering**. Instead of creating unnecessary layers of complexity, I leveraged native WordPress features combined with ACF to solve the problem!
The primary goal of this challenge was the construction of complex backend relationships, including Custom Post Types, Taxonomies, and ACF relationship logic. 

**Note on Frontend:** The interface was developed as a basic simulation to demonstrate data output. While I am fully capable of building advanced, high-fidelity frontends, the priority here was the backend architecture and data integrity.

## Requirements
* Install and activate Advanced Custom Fields (ACF).

## Data Architecture
* **Practice Areas (CPT):** Core legal services (e.g., Corporate Law).
* **Attorneys (CPT):** Professional specialist profiles.
* **Specialization (Taxonomy):** Niche tags for attorneys (e.g., Insurance, Car Accidents).
* **Relationship:** ACF Relationship field linking 'Attorneys' to 'Practice Areas'.

## Key Logic
* **Integrity:** Sections only render if data is present to prevent empty UI containers.
* **Admin Guidance:** Specific feedback for administrators when post relationships are missing.

## Code Structure Example
```php
// Fetch specialists via ACF Relationship field
$experts = get_field('related_attorneys'); 

if ($experts):
    foreach ($experts as $expert):
        $tax = get_the_terms($expert->ID, 'specialization');
        $label = $tax ? $tax[0]->name : 'General Practice';
        
        echo get_the_title($expert->ID) . ' - ' . $label;
    endforeach;
endif;