<?php
/**
 * Front page template.
 *
 * @package infra
 */

get_header();

$meanpug_avatar = 'https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png';
$card_one       = home_url( '/wp-content/themes/twentytwentyfour/assets/images/green-staircase.webp' );
$card_two       = home_url( '/wp-content/themes/twentytwentyfour/assets/images/tourist-and-building.webp' );
$card_three     = home_url( '/wp-content/themes/twentytwentyfour/assets/images/angular-roof.webp' );
?>
<main class="airpnp-homepage">
	<div class="airpnp-notice">
		<p>
			Get the latest on our COVID-19 response and cancellation policies.
			<a href="#"><?php esc_html_e( 'Learn more', 'inf' ); ?></a>
		</p>
	</div>

	<div class="airpnp-shell">
		<header class="airpnp-header">
			<div class="airpnp-brand">
				<svg width="102" height="32" viewBox="0 0 3490 1080" style="display:block"><path d="M1494.71 456.953C1458.28 412.178 1408.46 389.892 1349.68 389.892C1233.51 389.892 1146.18 481.906 1146.18 605.892C1146.18 729.877 1233.51 821.892 1349.68 821.892C1408.46 821.892 1458.28 799.605 1494.71 754.83L1500.95 810.195H1589.84V401.588H1500.95L1494.71 456.953ZM1369.18 736.895C1295.33 736.895 1242.08 683.41 1242.08 605.892C1242.08 528.373 1295.33 474.888 1369.18 474.888C1443.02 474.888 1495.49 529.153 1495.49 605.892C1495.49 682.63 1443.8 736.895 1369.18 736.895ZM1656.11 810.195H1750.46V401.588H1656.11V810.195ZM948.912 666.715C875.618 506.859 795.308 344.664 713.438 184.809C698.623 155.177 670.554 98.2527 645.603 67.8412C609.736 24.1733 556.715 0.779785 502.915 0.779785C449.115 0.779785 396.094 24.1733 360.227 67.8412C335.277 98.2527 307.207 155.177 292.392 184.809C210.522 344.664 130.212 506.859 56.9187 666.715C47.5621 687.769 24.9504 737.675 16.3736 760.289C6.2373 787.581 0.779297 817.213 0.779297 846.845C0.779297 975.509 101.362 1079.22 235.473 1079.22C346.193 1079.22 434.3 1008.26 502.915 934.18C571.53 1008.26 659.638 1079.22 770.357 1079.22C904.468 1079.22 1005.83 975.509 1005.83 846.845C1005.83 817.213 999.593 787.581 989.457 760.289C980.88 737.675 958.268 687.769 948.912 666.715ZM502.915 810.195C447.555 738.455 396.094 649.56 396.094 577.819C396.094 506.079 446.776 470.209 502.915 470.209C559.055 470.209 610.516 508.419 610.516 577.819C610.516 647.22 558.275 738.455 502.915 810.195ZM770.357 998.902C688.362 998.902 618.032 941.557 555.741 872.656C619.966 792.541 690.826 679.121 690.826 577.819C690.826 458.513 598.04 389.892 502.915 389.892C407.79 389.892 315.784 458.513 315.784 577.819C315.784 679.098 386.145 792.478 450.144 872.593C387.845 941.526 317.491 998.902 235.473 998.902C146.586 998.902 81.0898 931.061 81.0898 846.845C81.0898 826.57 84.2087 807.856 91.2261 788.361C98.2436 770.426 120.855 720.52 130.212 701.025C203.505 541.17 282.256 380.534 364.126 220.679C378.941 191.047 403.891 141.921 422.605 119.307C442.877 94.3538 470.947 81.0975 502.915 81.0975C534.883 81.0975 562.953 94.3538 583.226 119.307C601.939 141.921 626.89 191.047 641.704 220.679C723.574 380.534 802.325 541.17 875.618 701.025C884.975 720.52 907.587 770.426 914.604 788.361C921.622 807.856 925.52 826.57 925.52 846.845C925.52 931.061 859.244 998.902 770.357 998.902ZM3285.71 389.892C3226.91 389.892 3175.97 413.098 3139.91 456.953V226.917H3045.56V810.195H3134.45L3140.69 754.83C3177.12 799.605 3226.94 821.892 3285.71 821.892C3401.89 821.892 3489.22 729.877 3489.22 605.892C3489.22 481.906 3401.89 389.892 3285.71 389.892ZM3266.22 736.895C3191.6 736.895 3139.91 682.63 3139.91 605.892C3139.91 529.153 3191.6 474.888 3266.22 474.888C3340.85 474.888 3393.32 528.373 3393.32 605.892C3393.32 683.41 3340.07 736.895 3266.22 736.895ZM2827.24 389.892C2766.15 389.892 2723.56 418.182 2699.37 456.953L2693.13 401.588H2604.24V810.195H2698.59V573.921C2698.59 516.217 2741.47 474.888 2800.73 474.888C2856.87 474.888 2888.84 513.097 2888.84 578.599V810.195H2983.19V566.903C2983.19 457.733 2923.15 389.892 2827.24 389.892ZM1911.86 460.072L1905.62 401.588H1816.73V810.195H1911.08V604.332C1911.08 532.592 1954.74 486.585 2027.26 486.585C2042.85 486.585 2058.44 488.144 2070.92 492.043V401.588C2059.22 396.91 2044.41 395.35 2028.04 395.35C1978.58 395.35 1936.66 421.177 1911.86 460.072ZM2353.96 389.892C2295.15 389.892 2244.21 413.098 2208.15 456.953V226.917H2113.8V810.195H2202.69L2208.93 754.83C2245.36 799.605 2295.18 821.892 2353.96 821.892C2470.13 821.892 2557.46 729.877 2557.46 605.892C2557.46 481.906 2470.13 389.892 2353.96 389.892ZM2334.46 736.895C2259.84 736.895 2208.15 682.63 2208.15 605.892C2208.15 529.153 2259.84 474.888 2334.46 474.888C2409.09 474.888 2461.56 528.373 2461.56 605.892C2461.56 683.41 2408.31 736.895 2334.46 736.895ZM1703.28 226.917C1669.48 226.917 1642.08 254.326 1642.08 288.13C1642.08 321.934 1669.48 349.343 1703.28 349.343C1737.09 349.343 1764.49 321.934 1764.49 288.13C1764.49 254.326 1737.09 226.917 1703.28 226.917Z" fill="currentcolor"></path></svg>
			</div>

			<nav class="airpnp-top-nav" aria-label="<?php esc_attr_e( 'Top navigation', 'inf' ); ?>">
				<a href="#" class="airpnp-top-nav__lang" aria-label="<?php esc_attr_e( 'Language', 'inf' ); ?>">
					<span class="airpnp-top-nav__lang-globe" aria-hidden="true">
						<svg viewBox="0 0 24 24" focusable="false">
							<circle cx="12" cy="12" r="9"></circle>
							<ellipse cx="12" cy="12" rx="4.5" ry="9"></ellipse>
							<path d="M3 12h18"></path>
							<path d="M4.5 8h15"></path>
							<path d="M4.5 16h15"></path>
						</svg>
					</span>
					<span class="airpnp-top-nav__lang-caret" aria-hidden="true">
						<svg viewBox="0 0 10 6" focusable="false">
							<path d="M1 1l4 4 4-4"></path>
						</svg>
					</span>
				</a>
				<a href="#"><?php esc_html_e( 'Host your home', 'inf' ); ?></a>
				<a href="#"><?php esc_html_e( 'Host an experience', 'inf' ); ?></a>
				<a href="#"><?php esc_html_e( 'Help', 'inf' ); ?></a>
				<div class="airpnp-user-pill" aria-label="<?php esc_attr_e( 'User profile', 'inf' ); ?>">
					<span class="airpnp-user-pill__name">Bobby</span>
					<img src="<?php echo esc_url( $meanpug_avatar ); ?>" alt="<?php esc_attr_e( 'MeanPug avatar', 'inf' ); ?>" />
				</div>
			</nav>
		</header>

		<nav class="airpnp-tabs" aria-label="<?php esc_attr_e( 'Stay category navigation', 'inf' ); ?>">
			<a href="#" class="is-active"><?php esc_html_e( 'Places to stay', 'inf' ); ?></a>
			<a href="#"><?php esc_html_e( 'Monthly stays', 'inf' ); ?></a>
			<a href="#"><?php esc_html_e( 'Experiences', 'inf' ); ?></a>
			<a href="#">
				<?php esc_html_e( 'Online Experiences', 'inf' ); ?>
				<span class="airpnp-badge"><?php esc_html_e( 'NEW', 'inf' ); ?></span>
			</a>
		</nav>

		<section class="airpnp-search" aria-label="<?php esc_attr_e( 'Search form layout', 'inf' ); ?>">
			<div class="airpnp-search__field">
				<span class="airpnp-search__label"><?php esc_html_e( 'Location', 'inf' ); ?></span>
				<span class="airpnp-search__value"><?php esc_html_e( 'Where are you going?', 'inf' ); ?></span>
			</div>
			<div class="airpnp-search__field">
				<span class="airpnp-search__label"><?php esc_html_e( 'Check in / Check out', 'inf' ); ?></span>
				<span class="airpnp-search__value"><?php esc_html_e( 'Add dates', 'inf' ); ?></span>
			</div>
			<div class="airpnp-search__field">
				<span class="airpnp-search__label"><?php esc_html_e( 'Guests', 'inf' ); ?></span>
				<span class="airpnp-search__value"><?php esc_html_e( 'Add guests', 'inf' ); ?></span>
			</div>
			<button type="button" class="airpnp-search__button">
				<span class="airpnp-search__icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
						<circle cx="11" cy="11" r="6.5"></circle>
						<line x1="16" y1="16" x2="21" y2="21"></line>
					</svg>
				</span>
				<?php esc_html_e( 'Search', 'inf' ); ?>
			</button>
		</section>

		<section class="airpnp-hero">
			<div class="airpnp-hero__content">
				<h1><?php esc_html_e( 'We stand with #BlackLivesMatter', 'inf' ); ?></h1>
				<p>
					<?php esc_html_e( "Now more than ever, it's important that you know how we're fighting discrimination on Airbnb. We'd like to share our newest initiative with you, Project Lighthouse.", 'inf' ); ?>
				</p>
				<a href="#"><?php esc_html_e( 'Learn more', 'inf' ); ?></a>
			</div>
		</section>

		<section class="airpnp-cards" aria-label="<?php esc_attr_e( 'Featured cards', 'inf' ); ?>">
			<article class="airpnp-card"><img src="<?php echo esc_url( $card_one ); ?>" alt="<?php esc_attr_e( 'Decorative property card one', 'inf' ); ?>" /></article>
			<article class="airpnp-card"><img src="<?php echo esc_url( $card_two ); ?>" alt="<?php esc_attr_e( 'Decorative property card two', 'inf' ); ?>" /></article>
			<article class="airpnp-card"><img src="<?php echo esc_url( $card_three ); ?>" alt="<?php esc_attr_e( 'Decorative property card three', 'inf' ); ?>" /></article>
		</section>
	</div>
</main>
<?php
get_footer();
