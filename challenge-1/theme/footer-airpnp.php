<?php
/**
 * Footer used by the airPnP front page (Challenge 1).
 *
 * Reproduces the Airbnb global footer (inspiration grid + link columns +
 * bottom bar). Closes the #content / #page wrappers opened in
 * header-airpnp.php and fires wp_footer(). Loaded via get_footer( 'airpnp' ).
 *
 * @package infra
 */

$airpnp_inspiration = array(
	array( 'Pocono Mountains', __( 'Apartments', 'inf' ) ),
	array( 'Galveston', __( 'Vacation rentals', 'inf' ) ),
	array( 'Big Bear Lake', __( 'Vacation rentals', 'inf' ) ),
	array( 'West Palm Beach', __( 'Vacation rentals', 'inf' ) ),
	array( 'Charleston', __( 'Cottages', 'inf' ) ),
	array( 'Athens', __( 'Vacation rentals', 'inf' ) ),
	array( 'Dublin', __( 'Condos', 'inf' ) ),
	array( 'Portland', __( 'Apartments', 'inf' ) ),
	array( 'Minneapolis', __( 'Vacation rentals', 'inf' ) ),
	array( 'Madrid', __( 'Condos', 'inf' ) ),
	array( 'Florida Keys', __( 'Houses for rent', 'inf' ) ),
	array( 'Pittsburgh', __( 'Vacation rentals', 'inf' ) ),
	array( 'Las Vegas', __( 'Vacation rentals', 'inf' ) ),
	array( 'Cape Cod', __( 'Vacation rentals', 'inf' ) ),
	array( 'Wilmington', __( 'Condos', 'inf' ) ),
	array( 'Key West', __( 'Condos', 'inf' ) ),
	array( 'Dallas', __( 'Villas', 'inf' ) ),
	array( __( 'Show more', 'inf' ), '', true ),
);

$airpnp_columns = array(
	__( 'Support', 'inf' )  => array( __( 'Help Center', 'inf' ), __( 'Get help with a safety issue', 'inf' ), __( 'AirCover', 'inf' ), __( 'Anti-discrimination', 'inf' ), __( 'Disability support', 'inf' ), __( 'Cancellation options', 'inf' ), __( 'Report neighborhood concern', 'inf' ) ),
	__( 'Hosting', 'inf' )  => array( __( 'Pugify your home', 'inf' ), __( 'Host an experience', 'inf' ), __( 'Host a service', 'inf' ), __( 'AirCover for Hosts', 'inf' ), __( 'Hosting resources', 'inf' ), __( 'Community forum', 'inf' ), __( 'Hosting responsibly', 'inf' ) ),
	'airPnP'                => array( __( 'Summer 2026 release', 'inf' ), __( 'Newsroom', 'inf' ), __( 'Careers', 'inf' ), __( 'Investors', 'inf' ), __( 'airPnP.org shelters', 'inf' ) ),
);
?>
	</div><!-- #content -->

	<footer class="bg-[#F7F7F7] border-t border-[#DDDDDD] mt-4">
		<div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-12">

			<!-- Inspiration -->
			<h2 class="text-2xl font-bold text-[#222222] mb-6"><?php esc_html_e( 'Inspiration for future getaways', 'inf' ); ?></h2>

			<nav class="flex flex-wrap gap-x-8 gap-y-2 border-b border-[#DDDDDD] pb-3 mb-6 text-sm">
				<?php
				$airpnp_tabs = array( __( 'Popular', 'inf' ), __( 'Arts & culture', 'inf' ), __( 'Beach', 'inf' ), __( 'Mountains', 'inf' ), __( 'Outdoors', 'inf' ), __( 'Activities', 'inf' ) );
				foreach ( $airpnp_tabs as $i => $tab ) :
					$active = 0 === $i ? 'text-[#222222] font-semibold border-b-2 border-[#222222] pb-3 -mb-[13px]' : 'text-[#717171] hover:text-[#222222]';
					?>
					<a href="#" class="<?php echo esc_attr( $active ); ?>"><?php echo esc_html( $tab ); ?></a>
				<?php endforeach; ?>
			</nav>

			<ul class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-y-5 gap-x-6 border-b border-[#DDDDDD] pb-12 mb-12">
				<?php foreach ( $airpnp_inspiration as $place ) : ?>
					<li>
						<a href="#" class="block group">
							<?php if ( ! empty( $place[2] ) ) : ?>
								<span class="text-sm font-semibold text-[#222222] inline-flex items-center gap-1"><?php echo esc_html( $place[0] ); ?> <span aria-hidden="true">&or;</span></span>
							<?php else : ?>
								<span class="block text-sm font-semibold text-[#222222] group-hover:underline"><?php echo esc_html( $place[0] ); ?></span>
								<span class="block text-sm text-[#717171]"><?php echo esc_html( $place[1] ); ?></span>
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

			<!-- Link columns -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8 border-b border-[#DDDDDD] pb-10 mb-6">
				<?php foreach ( $airpnp_columns as $heading => $links ) : ?>
					<div>
						<h3 class="text-sm font-semibold text-[#222222] mb-4"><?php echo esc_html( $heading ); ?></h3>
						<ul class="space-y-3">
							<?php foreach ( $links as $link ) : ?>
								<li><a href="#" class="text-sm text-[#717171] hover:text-[#222222] hover:underline"><?php echo wp_kses_post( $link ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Bottom bar -->
			<div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-[#222222]">
				<div class="flex flex-wrap items-center gap-x-2 gap-y-1">
					<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> airPnP, a MeanPug joint</span>
					<span aria-hidden="true">&middot;</span><a href="#" class="hover:underline"><?php esc_html_e( 'Privacy', 'inf' ); ?></a>
					<span aria-hidden="true">&middot;</span><a href="#" class="hover:underline"><?php esc_html_e( 'Terms', 'inf' ); ?></a>
					<span aria-hidden="true">&middot;</span><a href="#" class="hover:underline"><?php esc_html_e( 'Sitemap', 'inf' ); ?></a>
				</div>

				<div class="flex items-center gap-5">
					<a href="#" class="flex items-center gap-2 font-semibold hover:underline">
						<i class="fi fi-rr-globe text-base leading-none" aria-hidden="true"></i>
						<?php esc_html_e( 'English (US)', 'inf' ); ?>
					</a>
					<a href="#" class="font-semibold hover:underline"><?php esc_html_e( '$ USD', 'inf' ); ?></a>
					<div class="flex items-center gap-4 text-[#222222] text-lg leading-none">
						<a href="#" class="hover:opacity-70" aria-label="<?php esc_attr_e( 'Facebook', 'inf' ); ?>"><i class="fi fi-brands-facebook" aria-hidden="true"></i></a>
						<a href="#" class="hover:opacity-70" aria-label="<?php esc_attr_e( 'Twitter', 'inf' ); ?>"><i class="fi fi-brands-twitter" aria-hidden="true"></i></a>
						<a href="#" class="hover:opacity-70" aria-label="<?php esc_attr_e( 'Instagram', 'inf' ); ?>"><i class="fi fi-brands-instagram" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
