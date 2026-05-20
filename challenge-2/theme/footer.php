<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infra
 */
?>
</div><!-- #content -->
<footer role="contentinfo" class="bg-stone-900 text-stone-100 mt-16">
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div>
            <?php if ( has_custom_logo() ) : ?>
                <div class="mb-4"><?php the_custom_logo(); ?></div>
            <?php else : ?>
                <h2 class="text-2xl font-bold mb-4"><?php bloginfo( 'name' ); ?></h2>
            <?php endif; ?>
            <?php
            $footer_about = function_exists( 'get_field' ) ? get_field( 'footer_about', 'option' ) : '';
            if ( ! empty( $footer_about ) ) :
                ?>
                <p class="text-sm text-stone-300"><?php echo esc_html( $footer_about ); ?></p>
            <?php endif; ?>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4"><?php esc_html_e( 'Navigate', 'inf' ); ?></h3>
            <?php
            if ( has_nav_menu( 'footer' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'space-y-2 text-sm text-stone-300',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ) );
            }
            ?>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4"><?php esc_html_e( 'Contact', 'inf' ); ?></h3>
            <?php
            $phone   = function_exists( 'get_field' ) ? get_field( 'contact_phone', 'option' ) : null;
            $email   = function_exists( 'get_field' ) ? get_field( 'contact_email', 'option' ) : null;
            $address = function_exists( 'get_field' ) ? get_field( 'contact_main_address', 'option' ) : null;
            ?>
            <ul class="space-y-2 text-sm text-stone-300">
                <?php if ( ! empty( $phone ) && is_array( $phone ) && ! empty( $phone['url'] ) ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $phone['url'] ); ?>" class="hover:text-white">
                            <?php echo esc_html( $phone['title'] ?: $phone['url'] ); ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ( ! empty( $email ) && is_array( $email ) && ! empty( $email['url'] ) ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $email['url'] ); ?>" class="hover:text-white">
                            <?php echo esc_html( $email['title'] ?: $email['url'] ); ?>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ( ! empty( $address ) && is_array( $address ) ) : ?>
                    <li class="not-italic">
                        <address class="not-italic">
                            <?php
                            $line1 = trim( ( $address['street_number'] ?? '' ) . ' ' . ( $address['street_name'] ?? '' ) );
                            $line2 = trim( ( $address['city'] ?? '' ) . ', ' . ( $address['state'] ?? '' ) . ' ' . ( $address['post_code'] ?? '' ) );
                            echo esc_html( $line1 );
                            ?><br /><?php
                            echo esc_html( $line2 );
                            ?>
                        </address>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4"><?php esc_html_e( 'Follow Us', 'inf' ); ?></h3>
            <?php $social = function_exists( 'get_field' ) ? get_field( 'social_profiles', 'option' ) : array(); ?>
            <?php if ( ! empty( $social ) && is_array( $social ) ) : ?>
                <ul class="flex space-x-4">
                    <?php foreach ( $social as $profile ) : ?>
                        <?php if ( ! empty( $profile['url'] ) ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $profile['url'] ); ?>" rel="noopener" target="_blank" class="text-stone-300 hover:text-white">
                                    <span class="sr-only"><?php echo esc_html( $profile['network'] ?? '' ); ?></span>
                                    <?php echo esc_html( ucfirst( (string) ( $profile['network'] ?? '' ) ) ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="border-t border-stone-700">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-start md:items-center text-xs text-stone-400">
            <p>&copy; <?php echo esc_html( (string) gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'inf' ); ?></p>
            <?php $disclaimer = function_exists( 'get_field' ) ? get_field( 'footer_disclaimer', 'option' ) : ''; ?>
            <?php if ( ! empty( $disclaimer ) ) : ?>
                <p class="mt-2 md:mt-0 md:max-w-2xl md:text-right"><?php echo esc_html( $disclaimer ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</footer>
</div>
<!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
