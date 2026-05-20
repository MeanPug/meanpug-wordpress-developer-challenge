<?php

/**
 * Front-page-only header.
 *
 * Loaded via `get_header( 'front-page' )` in front-page.php. Renders the
 * Airbnb-aesthetic COVID strip, main nav, and search card. Keeps the rest
 * of the site on the existing MeanPug header.php.
 *
 * @package Airpnp
 */

$pug_src       = get_stylesheet_directory_uri() . '/assets/images/airpnp-pug.png';
$logo_png_src  = get_stylesheet_directory_uri() . '/assets/images/logo.png';
$logo_webp_src = get_stylesheet_directory_uri() . '/assets/images/logo.webp';
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php wp_head(); ?>
</head>

<body <?php body_class('airpnp'); ?>>

	<a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 bg-black text-white px-3 py-2 rounded">
		<?php esc_html_e('Skip to content', 'inf'); ?>
	</a>

	<header role="banner" class="airpnp-header bg-white">
		<div class="airpnp-covid-strip bg-stone-100 text-center text-xs md:text-sm py-6 px-4">
			<?php esc_html_e('Get the latest on our COVID-19 response and cancellation policies.', 'inf'); ?>
			<a href="#" class="underline font-semibold ml-1"><?php esc_html_e('Learn more', 'inf'); ?></a>
		</div>

		<nav class="airpnp-nav" aria-label="<?php esc_attr_e('Primary', 'inf'); ?>">
			<div class="max-w-7xl mx-auto px-4 flex items-center justify-between py-4 gap-4">

				<a href="<?php echo esc_url(home_url('/')); ?>" class="airpnp-logo flex items-center gap-2 text-2xl font-bold text-[#FF385C] shrink-0" aria-label="<?php esc_attr_e('AirPnP home', 'inf'); ?>">
					<picture>
						<source srcset="<?php echo esc_url($logo_webp_src); ?>" type="image/webp">
						<img src="<?php echo esc_url($logo_png_src); ?>"
							alt=""
							width="28" height="28"
							loading="eager"
							fetchpriority="high"
							decoding="async">
					</picture>
					<span>airpnp</span>
				</a>

				<div class="airpnp-nav-right flex items-center gap-2 md:gap-4 shrink-0">
					<div class="airpnp-lang-pill relative">
						<button id="airpnp-lang-toggle" type="button"
							class="inline-flex items-center gap-1 p-2 rounded-full hover:bg-stone-100"
							aria-haspopup="true" aria-expanded="false"
							aria-controls="airpnp-lang-menu"
							aria-label="<?php esc_attr_e('Change language', 'inf'); ?>">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
								<circle cx="12" cy="12" r="10" />
								<path d="M2 12h20M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20" />
							</svg>
							<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<polyline points="6 9 12 15 18 9" />
							</svg>
						</button>

						<ul id="airpnp-lang-menu"
							class="airpnp-lang-menu absolute right-0 mt-2 w-48 bg-white border border-stone-200 rounded-xl shadow-lg py-2 list-none m-0 z-40"
							role="menu" hidden>
							<li role="none">
								<a role="menuitem" href="#" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-stone-100">
									<svg width="20" height="14" viewBox="0 0 7410 3900" aria-hidden="true" class="shrink-0 rounded-sm border border-stone-200">
										<rect width="7410" height="3900" fill="#b22234"/>
										<g fill="#fff">
											<rect y="300" width="7410" height="300"/>
											<rect y="900" width="7410" height="300"/>
											<rect y="1500" width="7410" height="300"/>
											<rect y="2100" width="7410" height="300"/>
											<rect y="2700" width="7410" height="300"/>
											<rect y="3300" width="7410" height="300"/>
										</g>
										<rect width="2964" height="2100" fill="#3c3b6e"/>
									</svg>
									<span>English</span>
								</a>
							</li>
							<li role="none">
								<a role="menuitem" href="#" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-stone-100">
									<svg width="20" height="14" viewBox="0 0 750 500" aria-hidden="true" class="shrink-0 rounded-sm border border-stone-200">
										<rect width="750" height="500" fill="#c60b1e"/>
										<rect y="125" width="750" height="250" fill="#ffc400"/>
									</svg>
									<span>Español</span>
								</a>
							</li>
						</ul>
					</div>

					<div class="airpnp-main-nav relative md:static">
						<button id="airpnp-main-nav-toggle" type="button"
							class="md:hidden inline-flex items-center p-2 rounded-full hover:bg-stone-100"
							aria-haspopup="true" aria-expanded="false"
							aria-controls="airpnp-main-nav-menu"
							aria-label="<?php esc_attr_e('Open main menu', 'inf'); ?>">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<line x1="3" y1="6" x2="21" y2="6" />
								<line x1="3" y1="12" x2="21" y2="12" />
								<line x1="3" y1="18" x2="21" y2="18" />
							</svg>
						</button>
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'nav',
								'container'       => false,
								'menu_id'         => 'airpnp-main-nav-menu',
								'menu_class'      => 'airpnp-host-nav flex flex-col md:flex-row absolute md:static right-0 md:right-auto top-full md:top-auto mt-2 md:mt-0 w-56 md:w-auto bg-white md:bg-transparent border md:border-0 border-stone-200 rounded-xl md:rounded-none shadow-lg md:shadow-none p-2 md:p-0 md:items-center gap-1 md:gap-2 list-none m-0 z-40',
								'items_wrap'      => '<ul id="%1$s" class="%2$s" hidden>%3$s</ul>',
								'fallback_cb'     => '__return_false',
								'depth'           => 1,
								'link_before'     => '<span class="block md:inline-block text-sm font-semibold hover:bg-stone-100 px-3 py-2 rounded-full">',
								'link_after'      => '</span>',
							)
						);
						?>
					</div>

					<?php if (is_user_logged_in()) :
						$current_user = wp_get_current_user(); ?>
						<div class="airpnp-user-pill relative">
							<button id="airpnp-user-pill-toggle" type="button"
								class="flex items-center gap-2 rounded-full pl-1 md:pl-3 pr-1 py-1 md:py-1 border border-stone-200 shadow-sm"
								aria-haspopup="true" aria-expanded="false"
								aria-controls="airpnp-user-pill-menu"
								aria-label="<?php esc_attr_e('User menu', 'inf'); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="hidden md:block">
									<line x1="3" y1="6" x2="21" y2="6" />
									<line x1="3" y1="12" x2="21" y2="12" />
									<line x1="3" y1="18" x2="21" y2="18" />
								</svg>
								<?php if ($current_user && $current_user->user_login) : ?>
									<span class="text-sm font-bold text-stone-700 hidden md:block"><?php echo esc_html($current_user->user_login); ?></span>
								<?php endif; ?>

								<img src="<?php echo esc_url($pug_src); ?>"
									alt="<?php esc_attr_e('AirPnP user avatar', 'inf'); ?>"
									width="32" height="32"
									class="rounded-full bg-stone-200 object-cover"
									loading="eager"
									fetchpriority="high">
							</button>
						<?php else : ?>
							<a href="<?php echo esc_url(wp_login_url()); ?>"
								class="airpnp-user-login-btn flex items-center gap-2 border border-stone-300 rounded-full pl-3 pr-1 py-1 hover:shadow-md transition-shadow text-sm font-semibold">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
									<line x1="3" y1="6" x2="21" y2="6" />
									<line x1="3" y1="12" x2="21" y2="12" />
									<line x1="3" y1="18" x2="21" y2="18" />
								</svg>
								<?php esc_html_e('Log in', 'inf'); ?>
								<img src="<?php echo esc_url($pug_src); ?>"
									alt="<?php esc_attr_e('AirPnP user avatar', 'inf'); ?>"
									width="32" height="32"
									class="rounded-full bg-stone-200 object-cover"
									loading="eager"
									fetchpriority="high">
							</a>
						<?php endif; ?>


						<ul id="airpnp-user-pill-menu"
							class="airpnp-user-pill-menu absolute right-0 mt-2 w-56 bg-white border border-stone-200 rounded-xl shadow-lg py-2 list-none m-0 z-40"
							role="menu" hidden>
							<?php if (is_user_logged_in()) : ?>
								<li role="none"><a role="menuitem" href="#" class="block px-4 py-2 text-sm font-semibold hover:bg-stone-100"><?php esc_html_e('My account', 'inf'); ?></a></li>
								<li role="none"><a role="menuitem" href="#" class="block px-4 py-2 text-sm hover:bg-stone-100"><?php esc_html_e('My bookings', 'inf'); ?></a></li>
							<?php else : ?>
								<li role="none"><a role="menuitem" href="#" class="block px-4 py-2 text-sm font-semibold hover:bg-stone-100"><?php esc_html_e('Sign up', 'inf'); ?></a></li>
								<li role="none"><a role="menuitem" href="#" class="block px-4 py-2 text-sm hover:bg-stone-100"><?php esc_html_e('Log in', 'inf'); ?></a></li>
							<?php endif; ?>
							<li role="none" class="border-t border-stone-200 my-2"></li>
							<li role="none"><a role="menuitem" href="#" class="block px-4 py-2 text-sm hover:bg-stone-100"><?php esc_html_e('Host your home', 'inf'); ?></a></li>
							<li role="none"><a role="menuitem" href="#" class="block px-4 py-2 text-sm hover:bg-stone-100"><?php esc_html_e('Help', 'inf'); ?></a></li>

						</ul>
					</div>
				</div>
			</div>
		</nav>

		<div class="airpnp-nav-tabs flex items-center gap-6 flex-1 max-w-7xl mx-auto px-4 pt-4 overflow-x-auto lg:overflow-visible scrollbar-hide" role="tablist" aria-label="<?php esc_attr_e( 'Browse categories', 'inf' ); ?>">
			<ul class="flex items-center gap-6 list-none m-0 p-0 whitespace-nowrap min-w-max">
				<li class="m-0">
					<a href="#" data-airpnp-tab role="tab" aria-selected="true"
						class="airpnp-nav-tab airpnp-nav-tab--active inline-flex items-center gap-1 py-3 text-sm font-semibold border-b-2 border-black shrink-0">
						<?php esc_html_e( 'Places to stay', 'inf' ); ?>
					</a>
				</li>
				<li class="m-0">
					<a href="#" data-airpnp-tab role="tab" aria-selected="false"
						class="airpnp-nav-tab inline-flex items-center gap-1 py-3 text-sm font-semibold text-stone-600 hover:text-black shrink-0">
						<?php esc_html_e( 'Monthly stays', 'inf' ); ?>
					</a>
				</li>
				<li class="m-0">
					<a href="#" data-airpnp-tab role="tab" aria-selected="false"
						class="airpnp-nav-tab inline-flex items-center gap-1 py-3 text-sm font-semibold text-stone-600 hover:text-black shrink-0">
						<?php esc_html_e( 'Experiences', 'inf' ); ?>
					</a>
				</li>
				<li class="m-0">
					<a href="#" data-airpnp-tab role="tab" aria-selected="false"
						class="airpnp-nav-tab inline-flex items-center gap-1 py-3 text-sm font-semibold text-stone-600 hover:text-black shrink-0">
						<?php esc_html_e( 'Online Experiences', 'inf' ); ?>
						<span aria-hidden="true" class="bg-stone-900 text-white text-[10px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">
							<?php esc_html_e( 'New', 'inf' ); ?>
						</span>
						<span class="sr-only"><?php esc_html_e( '(new)', 'inf' ); ?></span>
					</a>
				</li>
			</ul>
		</div>

		<div class="airpnp-search-wrap px-4 pb-10 pt-6 max-w-7xl mx-auto">
			<form id="airpnp-search-form" role="search"
				aria-label="<?php esc_attr_e('Find a stay', 'inf'); ?>"
				class="airpnp-search p-2 max-w-7xl mx-auto flex flex-col md:flex-row items-stretch md:items-center bg-white rounded-2xl md:rounded-lg border border-stone-200 shadow-lg md:shadow-md overflow-hidden">

				<div class="airpnp-search-cell flex-1 flex items-center gap-3 px-4 md:px-6 py-3 md:py-2 min-h-[56px]">
					<span class="airpnp-search-icon shrink-0 text-stone-500" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z" />
							<circle cx="12" cy="10" r="3" />
						</svg>
					</span>
					<div class="flex-1 min-w-0">
						<label for="airpnp-search-location" class="block text-[11px] font-bold uppercase tracking-wider text-stone-900"><?php esc_html_e('Location', 'inf'); ?></label>
						<input type="text" id="airpnp-search-location" name="location" maxlength="100"
							placeholder="<?php esc_attr_e('Where are you going?', 'inf'); ?>"
							class="block w-full bg-transparent text-base md:text-sm placeholder-stone-400 focus:outline-none" required>
					</div>
				</div>

				<div class="airpnp-search-cell flex-1 flex items-center gap-3 px-4 md:px-6 py-3 md:py-2 min-h-[56px] md:border-l md:border-stone-200">
					<span class="airpnp-search-icon shrink-0 text-stone-500" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
							<line x1="16" y1="2" x2="16" y2="6" />
							<line x1="8" y1="2" x2="8" y2="6" />
							<line x1="3" y1="10" x2="21" y2="10" />
						</svg>
					</span>
					<div class="flex-1 min-w-0">
						<label for="airpnp-search-dates" class="block text-[11px] font-bold uppercase tracking-wider text-stone-900"><?php esc_html_e('Check in / Check out', 'inf'); ?></label>
						<input type="text" id="airpnp-search-dates" readonly
							placeholder="<?php esc_attr_e('Add dates', 'inf'); ?>"
							class="block w-full bg-transparent text-base md:text-sm placeholder-stone-400 focus:outline-none cursor-pointer" required>
						<input type="hidden" name="checkin" id="airpnp-search-checkin">
						<input type="hidden" name="checkout" id="airpnp-search-checkout">
					</div>
				</div>

				<div class="airpnp-search-cell flex-1 flex items-center gap-3 px-4 md:px-6 py-3 md:py-2 min-h-[56px] md:border-l md:border-stone-200">
					<span class="airpnp-search-icon shrink-0 text-stone-500" aria-hidden="true">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
							<circle cx="9" cy="7" r="4" />
							<path d="M23 21v-2a4 4 0 0 0-3-3.87" />
							<path d="M16 3.13a4 4 0 0 1 0 7.75" />
						</svg>
					</span>
					<div class="flex-1 min-w-0">
						<label for="airpnp-search-guests" class="block text-[11px] font-bold uppercase tracking-wider text-stone-900"><?php esc_html_e('Guests', 'inf'); ?></label>
						<input type="number" id="airpnp-search-guests" name="guests" min="1" max="16" placeholder="1"
							class="block w-full bg-transparent text-base md:text-sm placeholder-stone-400 focus:outline-none" required>
					</div>
				</div>

				<div class="airpnp-search-submit-wrap px-2 pt-2 md:px-0 md:pt-0 md:pr-2">
					<button type="submit" class="airpnp-search-submit w-full md:w-auto flex items-center justify-center gap-2 bg-[#FF385C] hover:bg-[#E31C5F] text-white font-semibold px-6 py-4 md:py-3 rounded-xl md:rounded-md transition-colors min-h-[56px] md:min-h-0">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true">
							<circle cx="11" cy="11" r="7" />
							<line x1="21" y1="21" x2="16.65" y2="16.65" />
						</svg>
						<span><?php esc_html_e('Search', 'inf'); ?></span>
					</button>
				</div>
			</form>
		</div>
	</header>

	<div id="page" class="site">
		<div id="content" class="site-content">