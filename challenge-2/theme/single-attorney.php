<?php
/**
 * The template for displaying single `attorney` posts.
 *
 * @package infra
 */

get_header();
?>

<main id="main" role="main" class="max-w-7xl mx-auto px-6 py-12">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        $post_id   = get_the_ID();
        $thumbnail = get_the_post_thumbnail_url( $post_id, 'large' );

        $position       = '';
        $featured_quote = '';
        $contact_phone  = array();
        $contact_email  = '';
        $linkedin_url   = '';
        $bar_admissions = array();
        $education      = array();
        if ( function_exists( 'get_field' ) ) {
            $position       = (string) get_field( 'position', $post_id );
            $featured_quote = (string) get_field( 'featured_quote', $post_id );
            $contact_phone  = (array) get_field( 'contact_phone', $post_id );
            $contact_email  = (string) get_field( 'contact_email', $post_id );
            $linkedin_url   = (string) get_field( 'linkedin_url', $post_id );
            $bar_admissions = (array) get_field( 'bar_admissions', $post_id );
            $education      = (array) get_field( 'education', $post_id );
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
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'attorney' ) ); ?>" class="hover:text-blue-700 hover:underline">
                        <?php esc_html_e( 'Attorneys', 'inf' ); ?>
                    </a>
                </li>
                <li aria-hidden="true">/</li>
                <li aria-current="page" class="text-gray-900 font-semibold">
                    <?php echo esc_html( get_the_title() ); ?>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <?php if ( $thumbnail ) : ?>
                    <img
                        src="<?php echo esc_url( $thumbnail ); ?>"
                        alt="<?php echo esc_attr( get_the_title() ); ?>"
                        class="w-full aspect-square object-cover rounded-lg shadow"
                        loading="lazy"
                    />
                <?php endif; ?>
            </div>

            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
                    <?php the_title(); ?>
                </h1>

                <?php if ( $position ) : ?>
                    <p class="mt-2 text-lg text-gray-600 font-semibold">
                        <?php echo esc_html( $position ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $featured_quote ) : ?>
                    <blockquote class="mt-6 pl-4 border-l-4 border-blue-700 italic text-gray-700 leading-relaxed">
                        <?php echo esc_html( $featured_quote ); ?>
                    </blockquote>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12">
            <div class="lg:col-span-2 space-y-12">
                <div class="prose max-w-none">
                    <?php the_content(); ?>
                </div>

                <?php if ( ! empty( $bar_admissions ) ) : ?>
                    <section aria-labelledby="bar-admissions-heading">
                        <h2 id="bar-admissions-heading" class="text-2xl font-bold text-gray-900 mb-4">
                            <?php esc_html_e( 'Bar Admissions', 'inf' ); ?>
                        </h2>
                        <ul class="space-y-2 list-disc list-inside text-gray-700">
                            <?php foreach ( $bar_admissions as $admission ) : ?>
                                <?php
                                $state = isset( $admission['state'] ) ? (string) $admission['state'] : '';
                                $year  = isset( $admission['year'] ) ? (string) $admission['year'] : '';
                                if ( ! $state && ! $year ) {
                                    continue;
                                }
                                ?>
                                <li>
                                    <?php echo esc_html( trim( $state . ( $year ? ' (' . $year . ')' : '' ) ) ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endif; ?>

                <?php if ( ! empty( $education ) ) : ?>
                    <section aria-labelledby="education-heading">
                        <h2 id="education-heading" class="text-2xl font-bold text-gray-900 mb-4">
                            <?php esc_html_e( 'Education', 'inf' ); ?>
                        </h2>
                        <ul class="space-y-2 list-disc list-inside text-gray-700">
                            <?php foreach ( $education as $edu ) : ?>
                                <?php
                                $institution = isset( $edu['institution'] ) ? (string) $edu['institution'] : '';
                                $degree      = isset( $edu['degree'] ) ? (string) $edu['degree'] : '';
                                $year        = isset( $edu['year'] ) ? (string) $edu['year'] : '';
                                if ( ! $institution && ! $degree ) {
                                    continue;
                                }
                                $parts = array_filter( array( $institution, $degree, $year ) );
                                ?>
                                <li>
                                    <?php echo esc_html( implode( ' &mdash; ', $parts ) ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endif; ?>

                <?php
                $recent_case_ids = \PugPuggle\Queries\Case_Results::recent(
                    array(
                        'limit' => 3,
                    )
                );
                ?>
                <?php if ( ! empty( $recent_case_ids ) ) : ?>
                    <section aria-labelledby="recent-cases-heading">
                        <h2 id="recent-cases-heading" class="text-2xl font-bold text-gray-900 mb-6">
                            <?php esc_html_e( 'Recent Cases', 'inf' ); ?>
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php foreach ( $recent_case_ids as $case_id ) : ?>
                                <?php
                                $case_post = get_post( (int) $case_id );
                                if ( ! $case_post instanceof WP_Post ) {
                                    continue;
                                }
                                set_query_var( 'card_post', $case_post );
                                get_template_part( 'template-parts/cards/content', 'case-result-card' );
                                set_query_var( 'card_post', null );
                                ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>

            <aside class="lg:col-span-1 space-y-8">
                <section
                    class="bg-white rounded-lg shadow p-6"
                    aria-labelledby="contact-info-heading"
                >
                    <h2 id="contact-info-heading" class="text-lg font-bold text-gray-900 mb-4">
                        <?php esc_html_e( 'Contact', 'inf' ); ?>
                    </h2>
                    <ul class="space-y-3 text-gray-700">
                        <?php if ( ! empty( $contact_phone['url'] ) && ! empty( $contact_phone['title'] ) ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $contact_phone['url'] ); ?>" class="text-blue-700 hover:underline">
                                    <?php echo esc_html( $contact_phone['title'] ); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ( $contact_email ) : ?>
                            <li>
                                <a href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>" class="text-blue-700 hover:underline">
                                    <?php echo esc_html( $contact_email ); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ( $linkedin_url ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $linkedin_url ); ?>" class="text-blue-700 hover:underline" rel="noopener noreferrer" target="_blank">
                                    <?php esc_html_e( 'LinkedIn', 'inf' ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </section>

                <?php dynamic_sidebar( 'attorney-sidebar' ); ?>
            </aside>
        </div>

        <section class="mt-16 bg-blue-700 text-white rounded-lg p-8 md:p-12 text-center" aria-labelledby="cta-heading">
            <h2 id="cta-heading" class="text-2xl md:text-3xl font-bold">
                <?php esc_html_e( 'Schedule a Consultation', 'inf' ); ?>
            </h2>
            <p class="mt-3 text-blue-100">
                <?php esc_html_e( 'Get in touch to discuss your case with our team.', 'inf' ); ?>
            </p>
            <a
                href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                class="inline-block mt-6 px-6 py-3 bg-white text-blue-700 font-semibold rounded-lg hover:bg-gray-100 transition"
            >
                <?php esc_html_e( 'Contact Us', 'inf' ); ?>
            </a>
        </section>
    <?php endwhile; ?>
</main>

<?php
get_footer();
