<?php
/**
 * Front Page – Pug & Puggle Schema Overview
 *
 * Displays all registered custom post types and taxonomies
 * with direct links to their admin screens and REST API endpoints.
 * Serves as a developer‑facing reference, independent of ACF.
 *
 * @package PugPuggle
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Schema Overview – Pug &amp; Puggle</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 2rem;
            background: #fff;
            color: #1a1a1a;
        }
        h1, h2 {
            color: #2c3e50;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        .card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 1.25rem;
        }
        .card h3 {
            margin: 0 0 0.35rem;
            font-size: 1.15rem;
        }
        .card small {
            color: #6c757d;
            font-weight: 400;
        }
        .card .meta {
            margin: 0.5rem 0;
            font-size: 0.9rem;
        }
        .card .links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.75rem;
        }
        .card a {
            text-decoration: none;
            font-weight: 500;
            color: #0d6efd;
        }
        .card a:hover {
            text-decoration: underline;
        }
        .badge {
            background: #e2e3e5;
            border-radius: 4px;
            padding: 0.15rem 0.4rem;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <h1>Pug &amp; Puggle – Schema Overview</h1>

    <h2>Custom Post Types</h2>
    <div class="grid">
    <?php
    $custom_post_types = get_post_types( [ '_builtin' => false, 'public' => true ], 'objects' );
    foreach ( $custom_post_types as $slug => $cpt ) :
        // Build admin and REST links
        $admin_url = admin_url( "edit.php?post_type={$slug}" );
        $rest_url  = rest_url( "wp/v2/{$cpt->rest_base}" );
        ?>
        <div class="card">
            <h3>
                <?php echo esc_html( $cpt->label ); ?>
                <small>(<?php echo $cpt->hierarchical ? 'hierarchical' : 'flat'; ?>)</small>
            </h3>
            <div class="meta">
                <span class="badge"><?php echo esc_html( $slug ); ?></span>
            </div>
            <div class="links">
                <a href="<?php echo esc_url( $admin_url ); ?>">&#128451; Admin list</a>
                <a href="<?php echo esc_url( $rest_url ); ?>" target="_blank" rel="noopener">&#128279; REST endpoint</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <h2>Taxonomies</h2>
    <div class="grid">
    <?php
    $custom_taxonomies = get_taxonomies( [ '_builtin' => false, 'public' => true ], 'objects' );
    foreach ( $custom_taxonomies as $slug => $tax ) :
        $admin_url = admin_url( "edit-tags.php?taxonomy={$slug}" );
        $rest_url  = rest_url( "wp/v2/{$tax->rest_base}" );
        ?>
        <div class="card">
            <h3>
                <?php echo esc_html( $tax->label ); ?>
                <small>(<?php echo $tax->hierarchical ? 'hierarchical' : 'flat'; ?>)</small>
            </h3>
            <div class="meta">
                <span class="badge"><?php echo esc_html( $slug ); ?></span>
                <br>
                Attached to: <?php echo esc_html( implode( ', ', $tax->object_type ) ); ?>
            </div>
            <div class="links">
                <a href="<?php echo esc_url( $admin_url ); ?>">&#128451; Admin terms</a>
                <a href="<?php echo esc_url( $rest_url ); ?>" target="_blank" rel="noopener">&#128279; REST endpoint</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>