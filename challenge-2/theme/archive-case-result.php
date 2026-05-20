<?php
/**
 * Archive template for the `case-result` CPT.
 *
 * @package infra
 */

get_header();

$current_year     = (int) gmdate( 'Y' );
$year_options     = array();
for ( $y = $current_year; $y >= $current_year - 5; $y-- ) {
    $year_options[] = $y;
}

$practice_area_ids = get_posts(
    array(
        'post_type'   => 'practice-area',
        'numberposts' => -1,
        'fields'      => 'ids',
    )
);

$selected_year          = isset( $_GET['case_year'] ) ? (int) $_GET['case_year'] : 0;
$selected_practice_area = isset( $_GET['practice_area'] ) ? (int) $_GET['practice_area'] : 0;
?>

<main id="main" role="main" tabindex="-1">
    <header class="bg-stone-900 text-white px-6 py-16">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold">
                <?php esc_html_e( 'Case Results', 'inf' ); ?>
            </h1>
            <p class="mt-4 text-lg text-stone-200 max-w-2xl">
                <?php esc_html_e( 'Verdicts and settlements recovered for our clients.', 'inf' ); ?>
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <form
            method="get"
            action="<?php echo esc_url( get_post_type_archive_link( 'case-result' ) ); ?>"
            class="mb-8 flex flex-wrap items-end gap-4 bg-stone-50 p-6 rounded-lg"
            aria-label="<?php esc_attr_e( 'Filter case results', 'inf' ); ?>"
        >
            <div class="flex flex-col">
                <label for="case-year" class="text-sm font-semibold text-gray-700 mb-1">
                    <?php esc_html_e( 'Year', 'inf' ); ?>
                </label>
                <select
                    id="case-year"
                    name="case_year"
                    class="border border-stone-300 rounded-md px-3 py-2 bg-white"
                >
                    <option value=""><?php esc_html_e( 'All Years', 'inf' ); ?></option>
                    <?php foreach ( $year_options as $year_value ) : ?>
                        <option
                            value="<?php echo esc_attr( $year_value ); ?>"
                            <?php selected( $selected_year, $year_value ); ?>
                        >
                            <?php echo esc_html( $year_value ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="practice-area" class="text-sm font-semibold text-gray-700 mb-1">
                    <?php esc_html_e( 'Practice Area', 'inf' ); ?>
                </label>
                <select
                    id="practice-area"
                    name="practice_area"
                    class="border border-stone-300 rounded-md px-3 py-2 bg-white"
                >
                    <option value=""><?php esc_html_e( 'All Practice Areas', 'inf' ); ?></option>
                    <?php foreach ( $practice_area_ids as $pa_id ) : ?>
                        <option
                            value="<?php echo esc_attr( (int) $pa_id ); ?>"
                            <?php selected( $selected_practice_area, (int) $pa_id ); ?>
                        >
                            <?php echo esc_html( get_the_title( (int) $pa_id ) ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button
                type="submit"
                class="bg-stone-900 text-white px-6 py-2 rounded-md font-semibold hover:bg-stone-800 transition"
            >
                <?php esc_html_e( 'Filter', 'inf' ); ?>
            </button>
        </form>

        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/cards/content-case-result-card' ); ?>
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination(
                array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__( '← Previous', 'inf' ),
                    'next_text' => esc_html__( 'Next →', 'inf' ),
                    'class'     => 'mt-12 flex justify-center gap-2',
                )
            );
            ?>
        <?php else : ?>
            <p class="text-gray-600">
                <?php esc_html_e( 'No case results found.', 'inf' ); ?>
            </p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
