<?php
/**
 * ACF Field Group: Attorney
 *
 * Why these fields?
 *   Each field maps to a real content need on a law firm attorney bio page.
 *   - `headshot`: Mandatory image. Two sizes registered in functions.php.
 *   - `title`: Job title (Partner, Senior Associate). Separate from post title
 *     which holds the attorney name.
 *   - `bio_short`: 2-3 sentence bio for card grids. Prevents excerpt hacks.
 *   - `practice_areas`: Relationship to `practice-area` CPT. Drives the
 *     "This attorney handles X, Y, Z" block AND reverse queries on PA pages.
 *   - `offices`: Relationship to `office` CPT. Drives "Find this attorney at
 *     these locations" — zero address duplication.
 *   - `bar_admissions`: Repeater. Multiple states are common for large firms.
 *   - `education`: Repeater. Law school + graduation year.
 *   - `awards`: Repeater. Name + optional badge image.
 *   - `phone_direct`, `email`: Direct contact fields, separate from firm-wide.
 *   - `social_linkedin`: Most law firms only use LinkedIn for attorneys.
 *   - `video_intro`: Optional embed URL for attorney intro video.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

acf_add_local_field_group( array(
    'key'   => 'group_inf_attorney',
    'title' => __( 'Attorney Profile', 'inf' ),
    'fields' => array(

        // ── Identity ─────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_att_tab_identity',
            'label' => __( 'Identity', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'      => 'field_inf_att_headshot',
            'label'    => __( 'Headshot', 'inf' ),
            'name'     => 'headshot',
            'type'     => 'image',
            'required' => 1,
            'return_format' => 'array',
            'preview_size'  => 'attorney-headshot-square',
            'instructions'  => __( 'Minimum 720×720px. Crops automatically to square for card grids.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_att_job_title',
            'label'        => __( 'Job Title', 'inf' ),
            'name'         => 'job_title',
            'type'         => 'text',
            'instructions' => __( 'e.g. Partner, Senior Associate, Of Counsel', 'inf' ),
            'required'     => 1,
        ),
        array(
            'key'          => 'field_inf_att_bio_short',
            'label'        => __( 'Short Bio', 'inf' ),
            'name'         => 'bio_short',
            'type'         => 'textarea',
            'rows'         => 3,
            'instructions' => __( '2–3 sentences. Displayed on attorney card grids and archive listings.', 'inf' ),
            'required'     => 1,
        ),

        // ── Relationships ─────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_att_tab_relationships',
            'label' => __( 'Relationships', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_att_practice_areas',
            'label'        => __( 'Practice Areas', 'inf' ),
            'name'         => 'practice_areas',
            'type'         => 'relationship',
            'post_type'    => array( 'practice-area' ),
            'filters'      => array( 'search' ),
            'return_format' => 'object',
            'instructions' => __( 'Select the practice areas this attorney handles. Used in reverse queries on practice area pages.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_att_offices',
            'label'        => __( 'Offices', 'inf' ),
            'name'         => 'offices',
            'type'         => 'relationship',
            'post_type'    => array( 'office' ),
            'filters'      => array( 'search' ),
            'return_format' => 'object',
            'instructions' => __( 'Select the offices where this attorney is based.', 'inf' ),
        ),

        // ── Contact ───────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_att_tab_contact',
            'label' => __( 'Contact', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'   => 'field_inf_att_phone_direct',
            'label' => __( 'Direct Phone', 'inf' ),
            'name'  => 'phone_direct',
            'type'  => 'text',
        ),
        array(
            'key'   => 'field_inf_att_email',
            'label' => __( 'Email', 'inf' ),
            'name'  => 'email',
            'type'  => 'email',
        ),
        array(
            'key'   => 'field_inf_att_linkedin',
            'label' => __( 'LinkedIn URL', 'inf' ),
            'name'  => 'social_linkedin',
            'type'  => 'url',
        ),
        array(
            'key'          => 'field_inf_att_video_intro',
            'label'        => __( 'Intro Video URL', 'inf' ),
            'name'         => 'video_intro',
            'type'         => 'url',
            'instructions' => __( 'Optional. Wistia, YouTube, or Vimeo embed URL.', 'inf' ),
        ),

        // ── Credentials ───────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_att_tab_credentials',
            'label' => __( 'Credentials', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_att_bar_admissions',
            'label'        => __( 'Bar Admissions', 'inf' ),
            'name'         => 'bar_admissions',
            'type'         => 'repeater',
            'instructions' => __( 'List each state/court where this attorney is admitted to practice.', 'inf' ),
            'min'          => 0,
            'layout'       => 'table',
            'button_label' => __( 'Add Admission', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_att_bar_state',
                    'label' => __( 'State / Court', 'inf' ),
                    'name'  => 'state',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_inf_att_bar_year',
                    'label' => __( 'Year Admitted', 'inf' ),
                    'name'  => 'year',
                    'type'  => 'number',
                    'min'   => 1900,
                ),
            ),
        ),
        array(
            'key'          => 'field_inf_att_education',
            'label'        => __( 'Education', 'inf' ),
            'name'         => 'education',
            'type'         => 'repeater',
            'min'          => 0,
            'layout'       => 'table',
            'button_label' => __( 'Add Degree', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_att_edu_school',
                    'label' => __( 'School', 'inf' ),
                    'name'  => 'school',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_inf_att_edu_degree',
                    'label' => __( 'Degree', 'inf' ),
                    'name'  => 'degree',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_inf_att_edu_year',
                    'label' => __( 'Year', 'inf' ),
                    'name'  => 'year',
                    'type'  => 'number',
                    'min'   => 1900,
                ),
            ),
        ),
        array(
            'key'          => 'field_inf_att_awards',
            'label'        => __( 'Awards & Recognition', 'inf' ),
            'name'         => 'awards',
            'type'         => 'repeater',
            'min'          => 0,
            'layout'       => 'block',
            'button_label' => __( 'Add Award', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_att_award_name',
                    'label' => __( 'Award Name', 'inf' ),
                    'name'  => 'name',
                    'type'  => 'text',
                ),
                array(
                    'key'          => 'field_inf_att_award_badge',
                    'label'        => __( 'Badge Image', 'inf' ),
                    'name'         => 'badge',
                    'type'         => 'image',
                    'return_format' => 'array',
                    'instructions' => __( 'Optional. Award badge/logo image.', 'inf' ),
                ),
            ),
        ),

    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'attorney',
            ),
        ),
    ),
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
) );
