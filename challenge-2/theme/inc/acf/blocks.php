<?php

function register_block_acf_fields() {
    if( function_exists('acf_add_local_field_group') ):

    // 1. Hero Banner Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_hero_banner',
        'title' => 'Block: Hero Banner',
        'fields' => array(
            array(
                'key' => 'field_hero_headline',
                'label' => 'Headline',
                'name' => 'hero_headline',
                'type' => 'text',
                'default_value' => 'Fighting for the People',
            ),
            array(
                'key' => 'field_hero_subheadline',
                'label' => 'Subheadline',
                'name' => 'hero_subheadline',
                'type' => 'textarea',
                'default_value' => 'Our experienced attorneys are ready to fight for your rights.',
                'rows' => 2,
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_hero_cta_text',
                'label' => 'CTA Button Text',
                'name' => 'hero_cta_text',
                'type' => 'text',
                'default_value' => 'Free Case Evaluation',
            ),
            array(
                'key' => 'field_hero_cta_link',
                'label' => 'CTA Button Link',
                'name' => 'hero_cta_link',
                'type' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/hero-banner',
                ),
            ),
        ),
    ));

    // 2. Verdicts Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_verdicts',
        'title' => 'Block: Verdicts & Settlements',
        'fields' => array(
            array(
                'key' => 'field_verdicts_heading',
                'label' => 'Heading',
                'name' => 'verdicts_heading',
                'type' => 'text',
                'default_value' => 'Recent Verdicts & Settlements',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/verdicts',
                ),
            ),
        ),
    ));

    // 3. Featured Attorneys Fields
    acf_add_local_field_group(array(
        'key' => 'group_block_featured_attorneys',
        'title' => 'Block: Featured Attorneys',
        'fields' => array(
            array(
                'key' => 'field_attorneys_heading',
                'label' => 'Heading',
                'name' => 'attorneys_heading',
                'type' => 'text',
                'default_value' => 'Meet Our Experienced Team',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/featured-attorneys',
                ),
            ),
        ),
    ));

    endif;
}

add_action('acf/init', 'register_block_acf_fields');
