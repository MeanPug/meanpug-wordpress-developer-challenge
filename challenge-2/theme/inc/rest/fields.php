<?php
add_action('rest_api_init', 'pug_register_rest_fields');

function pug_register_rest_fields() {
    // "related" em practice_area, attorney, case_result
    $post_types = ['practice_area', 'attorney', 'case_result'];
    foreach ($post_types as $pt) {
        register_rest_field($pt, 'related', [
            'get_callback' => function($post) {
                // Exemplo: retornar post IDs relacionados armazenados em meta 'related_posts'
                $related_ids = get_post_meta($post['id'], 'related_posts', true);
                if (empty($related_ids) || !is_array($related_ids)) return [];
                $posts = get_posts(['post__in' => $related_ids, 'post_type' => 'any', 'posts_per_page' => -1]);
                return array_map(function($p) {
                    return [
                        'id'    => $p->ID,
                        'title' => $p->post_title,
                        'slug'  => $p->post_name,
                    ];
                }, $posts);
            },
            'schema' => [
                'description' => 'Related posts',
                'type'        => 'array',
                'items'       => ['type' => 'object']
            ],
        ]);
    }

    // case_result.amount_formatted
    register_rest_field('case_result', 'amount_formatted', [
        'get_callback' => function($post) {
            $amount = get_post_meta($post['id'], 'verdict_amount', true);
            if (!$amount) return '';
            // amount is in cents
            $dollars = $amount / 100;
            return '$' . number_format($dollars, 2);
        },
        'schema' => ['description' => 'Formatted verdict amount', 'type' => 'string'],
    ]);
}