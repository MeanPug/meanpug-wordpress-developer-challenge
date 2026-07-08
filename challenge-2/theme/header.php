<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section
 * and everything up until <div id="content">.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infra
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$contact_phone = function_exists( 'get_field' ) ? get_field( 'contact_phone', 'option' ) : null;

if ( ! is_array( $contact_phone ) ) {
	$contact_phone = array(
		'url'   => '#',
		'title' => __( 'Contact Us', 'inf' ),
	);
}

$contact_phone_url   = ! empty( $contact_phone['url'] ) ? $contact_phone['url'] : '#';
$contact_phone_title = ! empty( $contact_phone['title'] ) ? $contact_phone['title'] : __( 'Contact Us', 'inf' );
?>

<nav class="sticky bg-green inf-site-header z-20">
	<div class="container flex items-center justify-between pt-8 pb-6">
		<div class="w-48 lg:w-96">
			<?php echo get_custom_logo(); ?>
		</div>

		<!-- Desktop Nav -->
		<div class="pl-12 items-center justify-end hidden lg:flex">
			<div class="flex-grow">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'nav',
						'menu_class'     => 'inf-menu inf-menu--nav',
					)
				);
				?>
			</div>

			<div class="pl-8 text-center font-sans text-white-shade">
				<strong class="uppercase font-normal text-sm block tracking-widest">
					<?php esc_html_e( 'Free Call 24/7', 'inf' ); ?>
				</strong>

				<strong class="font-normal text-5xl block ps-link ps-link--square ps-link--square--white">
					<span class="inf-link--square__container">
						<a href="<?php echo esc_url( $contact_phone_url ); ?>" class="inf-link--square__link">
							<?php echo esc_html( $contact_phone_title ); ?>
						</a>
					</span>
				</strong>
			</div>
		</div>

		<!-- Mobile Nav -->
		<div class="xl:hidden">
			<div class="flex items-center">
				<a href="<?php echo esc_url( $contact_phone_url ); ?>">
					<img
						src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/icons/ic-phone.svg' ); ?>"
						alt="<?php esc_attr_e( 'Phone Icon', 'inf' ); ?>"
						class="w-7 mr-6"
					/>
				</a>

				<div class="xl:hidden relative">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'mobile-nav',
							'menu_class'     => 'header-menu',
						)
					);
					?>
				</div>
			</div>
		</div>
	</div>
</nav>

<div id="page" class="site">
	<div id="content" class="site-content">