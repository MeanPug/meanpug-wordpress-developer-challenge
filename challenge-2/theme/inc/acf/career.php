<?php
/**
 * ACF Field Group: Career
 *
 * Why these fields?
 *   Job listings have a distinct lifecycle and data shape from all other
 *   content. These fields support:
 *   - JobPosting schema (employment_type, remote_option, salary_range,
 *     closing_date, office relationship for location).
 *   - Programmatic expiry: a cron job can unpublish posts where
 *     closing_date < today() without any custom DB schema.
 *   - The `office` relationship provides location without duplicating the
 *     address — the office CPT owns that data.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

acf_add_local_field_group( array(
    'key'   => 'group_inf_career',
    'title' => __( 'Job Listing Details', 'inf' ),
    'fields' => array(

        // ── Position ──────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_car_tab_position',
            'label' => __( 'Position', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_car_department',
            'label'        => __( 'Department', 'inf' ),
            'name'         => 'department',
            'type'         => 'text',
            'instructions' => __( 'e.g. Legal, Operations, Marketing, IT', 'inf' ),
            'required'     => 1,
        ),
        array(
            'key'     => 'field_inf_car_employment_type',
            'label'   => __( 'Employment Type', 'inf' ),
            'name'    => 'employment_type',
            'type'    => 'select',
            'required' => 1,
            'choices' => array(
                'FULL_TIME'  => __( 'Full-Time', 'inf' ),
                'PART_TIME'  => __( 'Part-Time', 'inf' ),
                'CONTRACTOR' => __( 'Contract', 'inf' ),
                'TEMPORARY'  => __( 'Temporary', 'inf' ),
                'INTERN'     => __( 'Internship', 'inf' ),
            ),
            'default_value' => 'FULL_TIME',
            'instructions'  => __( 'Values align with schema.org JobPosting employmentType vocabulary.', 'inf' ),
        ),
        array(
            'key'     => 'field_inf_car_remote_option',
            'label'   => __( 'Remote Option', 'inf' ),
            'name'    => 'remote_option',
            'type'    => 'select',
            'choices' => array(
                'ONSITE' => __( 'On-site', 'inf' ),
                'REMOTE' => __( 'Remote', 'inf' ),
                'HYBRID' => __( 'Hybrid', 'inf' ),
            ),
            'default_value' => 'ONSITE',
        ),
        array(
            'key'          => 'field_inf_car_salary_range',
            'label'        => __( 'Salary Range', 'inf' ),
            'name'         => 'salary_range',
            'type'         => 'text',
            'instructions' => __( 'Optional display string, e.g. "$80,000 – $120,000". Used in JobPosting schema baseSalary.', 'inf' ),
            'placeholder'  => '$00,000 – $00,000',
        ),
        array(
            'key'          => 'field_inf_car_closing_date',
            'label'        => __( 'Application Closing Date', 'inf' ),
            'name'         => 'closing_date',
            'type'         => 'date_picker',
            'return_format' => 'Y-m-d',
            'display_format' => 'd/m/Y',
            'first_day'    => 1,
            'instructions' => __( 'Applications close at end of this day. Used in JobPosting schema validThrough.', 'inf' ),
        ),

        // ── Location ──────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_car_tab_location',
            'label' => __( 'Location', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_car_office',
            'label'        => __( 'Office Location', 'inf' ),
            'name'         => 'office',
            'type'         => 'post_object',
            'post_type'    => array( 'office' ),
            'return_format' => 'object',
            'ui'           => 1,
            'instructions' => __( 'Select the office where this role is primarily based. Address details are pulled from the Office post — no duplication.', 'inf' ),
        ),

        // ── Details ───────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_car_tab_details',
            'label' => __( 'Job Details', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_car_requirements',
            'label'        => __( 'Requirements', 'inf' ),
            'name'         => 'requirements',
            'type'         => 'wysiwyg',
            'toolbar'      => 'basic',
            'media_upload' => 0,
            'instructions' => __( 'Bullet-point list of qualifications, experience, and skills required.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_car_benefits',
            'label'        => __( 'Benefits', 'inf' ),
            'name'         => 'benefits',
            'type'         => 'wysiwyg',
            'toolbar'      => 'basic',
            'media_upload' => 0,
            'instructions' => __( 'Perks and benefits for this role.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_car_apply_url',
            'label'        => __( 'Application URL or Form', 'inf' ),
            'name'         => 'apply_url',
            'type'         => 'url',
            'instructions' => __( 'External ATS link (e.g. Lever, Greenhouse) or internal Gravity Form page URL.', 'inf' ),
        ),

    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'career',
            ),
        ),
    ),
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
) );
