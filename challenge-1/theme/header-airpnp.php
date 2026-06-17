<?php
/**
 * Header used by the airPnP front page (Challenge 1).
 *
 * This is intentionally self-contained and does NOT depend on the parent
 * Personal-Injury theme's ACF options (phone number, mega menu, etc.), so the
 * front page renders on a clean WordPress install.
 *
 * Loaded via get_header( 'airpnp' ).
 *
 * @package infra
 */

$airpnp_pug  = get_template_directory_uri() . '/assets/images/meanpug-pug.png';
$airpnp_logo = get_template_directory_uri() . '/assets/images/airpnp-logo.png';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'airpnp bg-white' ); ?>>

<div id="page" class="site">
	<div id="content" class="site-content">

		<!-- Announcement bar -->
		<div class="w-full bg-[#F7F7F7] border-b border-[#EBEBEB] text-center text-xs text-[#222222] py-2 px-4">
			<?php esc_html_e( 'Get the latest on our pug-friendly stays and flexible cancellation policies.', 'inf' ); ?>
			<a href="#" class="font-semibold underline"><?php esc_html_e( 'Learn more', 'inf' ); ?></a>
		</div>

		<header class="w-full bg-white border-b border-[#EBEBEB] sticky top-0 z-20">
			<div class="max-w-[1280px] mx-auto px-6 lg:px-10">

				<!-- Top row: logo / primary nav / account -->
				<div class="flex items-center justify-between h-20">

					<!-- Logo (pugified) -->
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 text-[#FF385C] shrink-0">
						<img src="<?php echo esc_url( $airpnp_logo ); ?>" alt="<?php esc_attr_e( 'airPnP', 'inf' ); ?>" class="h-9 w-9 rounded-lg" />
						<span class="text-2xl font-bold tracking-tight lowercase">airpnp</span>
					</a>

					<!-- Primary nav -->
					<nav class="hidden lg:flex items-center gap-7 text-sm font-medium">
						<a href="#" class="text-[#222222] border-b-2 border-[#222222] pb-1"><?php esc_html_e( 'Places to stay', 'inf' ); ?></a>
						<a href="#" class="text-[#717171] hover:text-[#222222]"><?php esc_html_e( 'Monthly stays', 'inf' ); ?></a>
						<a href="#" class="text-[#717171] hover:text-[#222222]"><?php esc_html_e( 'Experiences', 'inf' ); ?></a>
						<a href="#" class="text-[#717171] hover:text-[#222222] flex items-center gap-1">
							<?php esc_html_e( 'Online Experiences', 'inf' ); ?>
							<span class="bg-[#222222] text-white text-[10px] font-bold leading-none px-1.5 py-1 rounded"><?php esc_html_e( 'NEW', 'inf' ); ?></span>
						</a>
					</nav>

					<!-- Account / host -->
					<div class="flex items-center gap-1 shrink-0">
						<a href="#" class="hidden md:inline-block text-sm font-medium text-[#222222] px-4 py-2 rounded-full hover:bg-[#F7F7F7]">
							<?php esc_html_e( 'Become a host', 'inf' ); ?>
						</a>
						<button type="button" class="hidden md:flex items-center justify-center w-10 h-10 rounded-full hover:bg-[#F7F7F7] text-[#222222]" aria-label="<?php esc_attr_e( 'Choose a language', 'inf' ); ?>">
							<i class="fi fi-rr-globe text-base leading-none" aria-hidden="true"></i>
						</button>
						<div class="flex items-center gap-3 border border-[#DDDDDD] rounded-full py-1 pl-3 pr-1 hover:shadow-md transition-shadow cursor-pointer">
							<i class="fi fi-rr-menu-burger text-base leading-none text-[#222222]" aria-hidden="true"></i>
							<img src="<?php echo esc_url( $airpnp_pug ); ?>" alt="<?php esc_attr_e( 'Your pug profile', 'inf' ); ?>" class="w-8 h-8 rounded-full bg-[#717171] object-cover" />
						</div>
					</div>
				</div>

				<!-- Search pill -->
				<div class="pb-6 -mt-1 flex justify-center">
					<form class="airpnp-search flex items-center bg-white border border-[#DDDDDD] rounded-full" role="search" onsubmit="return false;">
						<label class="airpnp-search__segment w-72 text-left pl-8 pr-4 py-3 cursor-pointer">
							<span class="block text-xs font-semibold text-[#222222] uppercase tracking-wide"><?php esc_html_e( 'Location', 'inf' ); ?></span>
							<input type="text" class="block w-full bg-transparent text-sm text-[#222222] placeholder-[#717171] focus:outline-none" placeholder="<?php esc_attr_e( 'Where are you going?', 'inf' ); ?>" />
						</label>

						<label class="airpnp-search__segment w-36 text-left px-6 py-3 cursor-pointer">
							<span class="block text-xs font-semibold text-[#222222] uppercase tracking-wide"><?php esc_html_e( 'Check in', 'inf' ); ?></span>
							<span class="block text-sm text-[#717171]"><?php esc_html_e( 'Add dates', 'inf' ); ?></span>
						</label>

						<label class="airpnp-search__segment w-36 text-left px-6 py-3 cursor-pointer">
							<span class="block text-xs font-semibold text-[#222222] uppercase tracking-wide"><?php esc_html_e( 'Check out', 'inf' ); ?></span>
							<span class="block text-sm text-[#717171]"><?php esc_html_e( 'Add dates', 'inf' ); ?></span>
						</label>

						<div class="airpnp-search__segment flex items-center justify-between gap-3 pl-6 pr-2 py-2">
							<div>
								<span class="block text-xs font-semibold text-[#222222] uppercase tracking-wide"><?php esc_html_e( 'Guests', 'inf' ); ?></span>
								<span class="block text-sm text-[#717171]"><?php esc_html_e( 'Add guests', 'inf' ); ?></span>
							</div>
							<button type="submit" class="flex items-center gap-2 bg-[#FF385C] hover:bg-[#E00B41] text-white font-semibold text-sm rounded-full px-4 py-3 transition-colors">
								<i class="fi fi-rr-search text-sm leading-none" aria-hidden="true"></i>
								<?php esc_html_e( 'Search', 'inf' ); ?>
							</button>
						</div>
					</form>
				</div>
			</div>
		</header>
