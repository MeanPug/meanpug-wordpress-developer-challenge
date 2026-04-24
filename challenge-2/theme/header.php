<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infra
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav class="inf-site-header">
    <div class="inf-site-header__inner">
        <div class="inf-site-brand">
            <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inf-site-title"><?php bloginfo( 'name' ); ?></a>
            <?php endif; ?>
        </div>

        <?php if ( has_nav_menu( 'nav' ) ) : ?>
            <div class="inf-site-nav">
                <?php wp_nav_menu( array(
                    'theme_location' => 'nav',
                    'menu_class' => 'inf-menu inf-menu--nav',
                    'fallback_cb' => false,
                ) ); ?>
            </div>
        <?php endif; ?>

        <?php
        if ( function_exists( 'get_field' ) ) {
            $contact_phone = get_field( 'contact_phone', 'option' );
        }

        if ( ! is_array( $contact_phone ) || empty( $contact_phone['title'] ) ) {
            $contact_phone = array(
                'url'   => '#contact',
                'title' => __( 'Contact Us', 'inf' ),
            );
        }
        ?>

        <div class="inf-site-actions">
            <a href="<?php echo esc_url( $contact_phone['url'] ); ?>" class="inf-link--square__link">
                <?php echo esc_html( $contact_phone['title'] ); ?>
            </a>
        </div>
    </div>
</nav>

<div id="page" class="site">

	<div id="content" class="site-content">
