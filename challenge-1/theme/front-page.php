<?php
/**
 * Front page template — AirPnP aesthetic above-the-fold.
 *
 * Renders the queried object's content (a static front-page's blocks, or
 * the latest-posts list if `show_on_front` is set to "posts"). When no
 * content is available (fresh install before the seed runs), falls back
 * to a bare airpnp/listing-cards render so the fold still reads correctly.
 *
 * The listing-cards block has its own transient-cached data layer
 * (see Airpnp\Front_Page::get_listing_cards), so wherever the editor
 * drops it, it stays cheap.
 *
 * @package Airpnp
 */

get_header( 'front-page' );
?>
<main id="main" class="site-main">
	<?php
	// Render the queried object's content (a static front-page's blocks,
	// or the latest posts' content). The editor is expected to place the
	// listing-cards block where they want it; we only fall back to a bare
	// listing-cards render when there's no content at all (fresh installs).
	if ( have_posts() ) {
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	} else {
		echo do_blocks( '<!-- wp:airpnp/listing-cards /-->' );
	}
	?>
</main>
<?php
get_footer();
