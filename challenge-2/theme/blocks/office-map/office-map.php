<?php
/**
 * Office Map render template.
 *
 * @package PugPuggle
 *
 * @var array    $attributes
 * @var WP_Block $block
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'office-map' );
}

$heading = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : __( 'Visit an Office', 'inf' );

$offices = array();
if ( class_exists( '\\PugPuggle\\Queries\\Offices' ) ) {
	$offices = (array) \PugPuggle\Queries\Offices::all();
}

$pins       = array();
$block_uid  = isset( $block ) && is_object( $block ) && isset( $block->name ) ? $block->name : 'office-map';
$map_dom_id = 'pp-office-map-' . substr( md5( $block_uid . wp_json_encode( $attributes ) ), 0, 8 );

foreach ( $offices as $office ) {
	$office_post = $office;
	if ( is_numeric( $office ) ) {
		$office_post = get_post( (int) $office );
	}
	if ( ! $office_post instanceof WP_Post ) {
		continue;
	}

	$lat     = 0.0;
	$lng     = 0.0;
	$address = '';

	if ( function_exists( 'get_field' ) ) {
		$lat_val = get_field( 'latitude', $office_post->ID );
		$lng_val = get_field( 'longitude', $office_post->ID );
		$addr    = get_field( 'address', $office_post->ID );

		if ( null !== $lat_val && '' !== $lat_val ) {
			$lat = (float) $lat_val;
		}
		if ( null !== $lng_val && '' !== $lng_val ) {
			$lng = (float) $lng_val;
		}
		if ( is_array( $addr ) && ! empty( $addr['address'] ) ) {
			$address = (string) $addr['address'];
		} elseif ( is_string( $addr ) ) {
			$address = $addr;
		}
	}

	$pins[] = array(
		'id'      => (int) $office_post->ID,
		'title'   => get_the_title( $office_post ),
		'lat'     => $lat,
		'lng'     => $lng,
		'address' => $address,
	);
}

if ( function_exists( 'mp_load_google_maps_sdk' ) ) {
	mp_load_google_maps_sdk();
}
?>
<section class="inf-block inf-office-map py-16 px-6 max-w-7xl mx-auto">
	<?php if ( '' !== $heading ) : ?>
		<h2 class="text-3xl md:text-4xl font-bold text-center"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<div
		id="<?php echo esc_attr( $map_dom_id ); ?>"
		class="w-full h-96 rounded-lg mt-10 bg-stone-200"
		data-pugpuggle-office-map
	></div>

	<?php if ( ! empty( $pins ) ) : ?>
		<ul class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
			<?php foreach ( $pins as $pin ) : ?>
				<li class="p-4 border border-stone-200 rounded">
					<h3 class="font-semibold text-lg"><?php echo esc_html( $pin['title'] ); ?></h3>
					<?php if ( '' !== $pin['address'] ) : ?>
						<p class="mt-1 text-stone-600"><?php echo esc_html( $pin['address'] ); ?></p>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<script>
		(function () {
			window.pugpuggleOfficeMaps = window.pugpuggleOfficeMaps || {};
			window.pugpuggleOfficeMaps[<?php echo wp_json_encode( $map_dom_id ); ?>] = <?php echo wp_json_encode( $pins ); ?>;
		}());
	</script>
</section>
