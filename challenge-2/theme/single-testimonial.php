<?php
/**
 * The template for displaying single `testimonials` posts.
 *
 * @package infra
 */

get_header();
?>

<main id="main" role="main" class="max-w-3xl mx-auto px-6 py-12">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        $post_id = get_the_ID();

        $rating        = 0;
        $reviewer_name = '';
        $practice_area = null;
        if ( function_exists( 'get_field' ) ) {
            $rating   = (int) get_field( 'rating', $post_id );
            $reviewer = get_field( 'reviewer', $post_id );
            if ( is_array( $reviewer ) && ! empty( $reviewer['name'] ) ) {
                $reviewer_name = (string) $reviewer['name'];
            }
            $practice_area = get_field( 'practice_area', $post_id );
        }

        if ( $rating < 0 ) {
            $rating = 0;
        }
        if ( $rating > 5 ) {
            $rating = 5;
        }
        ?>

        <nav class="text-sm text-gray-600 mb-6" aria-label="<?php esc_attr_e( 'Breadcrumb', 'inf' ); ?>">
            <ol class="flex flex-wrap items-center gap-2">
                <li>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-blue-700 hover:underline">
                        <?php esc_html_e( 'Home', 'inf' ); ?>
                    </a>
                </li>
                <li aria-hidden="true">/</li>
                <li>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'testimonials' ) ); ?>" class="hover:text-blue-700 hover:underline">
                        <?php esc_html_e( 'Testimonials', 'inf' ); ?>
                    </a>
                </li>
                <li aria-hidden="true">/</li>
                <li aria-current="page" class="text-gray-900 font-semibold">
                    <?php echo esc_html( get_the_title() ); ?>
                </li>
            </ol>
        </nav>

        <div
            class="flex items-center text-yellow-500 text-2xl mb-4"
            aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %d out of 5 stars', 'inf' ), $rating ) ); ?>"
        >
            <?php
            for ( $i = 1; $i <= 5; $i++ ) :
                $char = ( $i <= $rating ) ? '&#9733;' : '&#9734;';
                ?>
                <span aria-hidden="true"><?php echo $char; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
            <?php endfor; ?>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
            <?php the_title(); ?>
        </h1>

        <blockquote class="border-l-4 border-blue-700 pl-6 italic text-lg text-gray-700 leading-relaxed">
            <?php the_content(); ?>
        </blockquote>

        <?php if ( $reviewer_name ) : ?>
            <p class="mt-6 text-base font-semibold text-gray-900">
                &mdash; <?php echo esc_html( $reviewer_name ); ?>
            </p>
        <?php endif; ?>

        <?php if ( $practice_area instanceof WP_Post ) : ?>
            <p class="mt-8 text-sm text-gray-600">
                <?php esc_html_e( 'Related Practice Area:', 'inf' ); ?>
                <a
                    href="<?php echo esc_url( get_permalink( $practice_area->ID ) ); ?>"
                    class="text-blue-700 font-semibold hover:underline"
                >
                    <?php echo esc_html( get_the_title( $practice_area->ID ) ); ?>
                </a>
            </p>
        <?php endif; ?>
    <?php endwhile; ?>
</main>

<?php
get_footer();
