<?php
/**
 * Front page — schema overview for Pug & Puggle, ESQ.
 *
 * Challenge 2 is backend-focused, so the home page here is a
 * developer-facing overview of the registered post types and
 * taxonomies with direct links into the admin and REST endpoints.
 * Self-contained: does not call get_header()/get_footer() (the
 * starter header.php depends on ACF which isn't installed).
 *
 * @package pnp
 */

$cpts = get_post_types( array( '_builtin' => false ), 'objects' );
$taxes = get_taxonomies( array( '_builtin' => false ), 'objects' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tailwindcss.com"></script>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-gray-50 text-gray-900 antialiased' ); ?>>

<div class="max-w-5xl mx-auto px-6 py-12">

	<header class="mb-10">
		<p class="text-xs font-semibold uppercase tracking-widest text-amber-700">Challenge 2 — Backend Schema</p>
		<h1 class="mt-2 text-4xl font-extrabold tracking-tight">Pug &amp; Puggle, ESQ.</h1>
		<p class="mt-2 text-gray-600">Custom post types, taxonomies, and REST endpoints registered by the <code class="bg-gray-100 px-1 rounded">challenge-2-theme</code>.</p>
		<div class="mt-4 flex gap-3 text-sm">
			<a href="<?php echo esc_url( admin_url() ); ?>" class="inline-flex items-center gap-1 rounded-md bg-gray-900 text-white px-3 py-1.5 font-medium hover:bg-gray-700">Open WP Admin &rarr;</a>
			<a href="<?php echo esc_url( home_url( '/wp-json/' ) ); ?>" class="inline-flex items-center gap-1 rounded-md border border-gray-300 px-3 py-1.5 font-medium hover:bg-white">View REST index</a>
		</div>
	</header>

	<section class="mb-10">
		<h2 class="text-xl font-bold mb-3">Custom Post Types</h2>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<?php foreach ( $cpts as $pt ) :
				$rest_path  = '/wp-json/wp/v2/' . ( $pt->rest_base ?: $pt->name );
				$admin_link = admin_url( 'edit.php?post_type=' . $pt->name );
				$count      = wp_count_posts( $pt->name );
				$published  = isset( $count->publish ) ? (int) $count->publish : 0;
			?>
				<article class="bg-white rounded-lg border border-gray-200 p-4">
					<div class="flex items-center justify-between">
						<h3 class="font-semibold"><?php echo esc_html( $pt->label ); ?></h3>
						<span class="text-[11px] font-mono bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded"><?php echo esc_html( $pt->name ); ?></span>
					</div>
					<p class="text-sm text-gray-500 mt-1">Published: <?php echo (int) $published; ?></p>
					<div class="mt-3 flex gap-2 text-xs">
						<a href="<?php echo esc_url( $admin_link ); ?>" class="text-blue-600 hover:underline">Manage</a>
						<a href="<?php echo esc_url( $rest_path ); ?>" class="text-blue-600 hover:underline">REST</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="mb-10">
		<h2 class="text-xl font-bold mb-3">Custom Taxonomies</h2>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
			<?php foreach ( $taxes as $t ) :
				$rest_path  = '/wp-json/wp/v2/' . ( $t->rest_base ?: $t->name );
				$admin_link = admin_url( 'edit-tags.php?taxonomy=' . $t->name );
			?>
				<article class="bg-white rounded-lg border border-gray-200 p-4">
					<div class="flex items-center justify-between">
						<h3 class="font-semibold"><?php echo esc_html( $t->label ); ?></h3>
						<span class="text-[11px] font-mono bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded"><?php echo esc_html( $t->name ); ?></span>
					</div>
					<p class="text-sm text-gray-500 mt-1">Attached to: <?php echo esc_html( implode( ', ', (array) $t->object_type ) ); ?></p>
					<div class="mt-3 flex gap-2 text-xs">
						<a href="<?php echo esc_url( $admin_link ); ?>" class="text-blue-600 hover:underline">Manage</a>
						<a href="<?php echo esc_url( $rest_path ); ?>" class="text-blue-600 hover:underline">REST</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<footer class="text-xs text-gray-500 pt-6 border-t border-gray-200">
		This page is intentionally lightweight — Challenge 2's deliverable is the backend schema under <code class="bg-gray-100 px-1 rounded">theme/inc/</code>.
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
