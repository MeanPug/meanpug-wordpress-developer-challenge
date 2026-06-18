<?php
/**
 * Block: Search Bar
 *
 * Airbnb-style segmented search pill (Location / Check in / Check out /
 * Guests + Search). Structure and hover mirror the airPnP design reference;
 * all styling lives in main.css under the .search-bar namespace.
 *
 * @var array $attributes
 */

$d = function ($key, $fallback) use ($attributes) {
	return isset($attributes[$key]) && $attributes[$key] !== '' ? $attributes[$key] : $fallback;
};

$location_label = $d('locationLabel', __('Location', 'gwblueprint'));
$location_ph    = $d('locationPlaceholder', __('Where are you going?', 'gwblueprint'));
$checkin_label  = $d('checkinLabel', __('Check in', 'gwblueprint'));
$checkin_value  = $d('checkinValue', __('Add dates', 'gwblueprint'));
$checkout_label = $d('checkoutLabel', __('Check out', 'gwblueprint'));
$checkout_value = $d('checkoutValue', __('Add dates', 'gwblueprint'));
$guests_label   = $d('guestsLabel', __('Guests', 'gwblueprint'));
$guests_value   = $d('guestsValue', __('Add guests', 'gwblueprint'));
$button_text    = $d('buttonText', __('Search', 'gwblueprint'));

$action     = isset($attributes['actionUrl']) ? trim($attributes['actionUrl']) : '';
$action_url = !empty($action) ? esc_url($action) : esc_url(home_url('/'));
?>
<form class="search-bar" role="search" method="get" action="<?php echo $action_url; ?>">
	<label class="search-bar__segment search-bar__segment--location">
		<span class="search-bar__label"><?php echo esc_html($location_label); ?></span>
		<input type="search" name="s" class="search-bar__input" placeholder="<?php echo esc_attr($location_ph); ?>" />
	</label>

	<div class="search-bar__segment">
		<span class="search-bar__label"><?php echo esc_html($checkin_label); ?></span>
		<span class="search-bar__value"><?php echo esc_html($checkin_value); ?></span>
	</div>

	<div class="search-bar__segment">
		<span class="search-bar__label"><?php echo esc_html($checkout_label); ?></span>
		<span class="search-bar__value"><?php echo esc_html($checkout_value); ?></span>
	</div>

	<div class="search-bar__segment search-bar__segment--guests">
		<span class="search-bar__guests">
			<span class="search-bar__label"><?php echo esc_html($guests_label); ?></span>
			<span class="search-bar__value"><?php echo esc_html($guests_value); ?></span>
		</span>
		<button type="submit" class="search-bar__btn">
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M10 2a8 8 0 105.29 14.03l5.34 5.34 1.42-1.42-5.34-5.34A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/></svg>
			<span><?php echo esc_html($button_text); ?></span>
		</button>
	</div>
</form>
