<?php
/**
 * Block: Icon Chip
 *
 * A 40x40 chip with a centered icon (SVG), a link, and configurable
 * background + hover background colors. Colors are emitted as CSS custom
 * properties so the hover state lives in main.css (.icon-chip).
 *
 * @var array $attributes
 */

$icon_value = isset($attributes['icon']) ? $attributes['icon'] : '';
$icon_url   = !empty($icon_value) ? gw_get_image_url($icon_value, 'full') : '';
$link       = isset($attributes['link']) ? trim($attributes['link']) : '';
$bg         = isset($attributes['bg']) ? trim($attributes['bg']) : '';
$bg_hover   = isset($attributes['bgHover']) ? trim($attributes['bgHover']) : '';

// Per-instance colors -> CSS variables consumed by .icon-chip in main.css.
$style = '';
if (!empty($bg)) {
	$style .= '--chip-bg:' . esc_attr($bg) . ';';
}
if (!empty($bg_hover)) {
	$style .= '--chip-bg-hover:' . esc_attr($bg_hover) . ';';
}

$tag        = !empty($link) ? 'a' : 'span';
$href_attr  = !empty($link) ? ' href="' . esc_url($link) . '"' : '';
$style_attr = !empty($style) ? ' style="' . $style . '"' : '';
?>
<<?php echo $tag . $href_attr; ?> class="icon-chip"<?php echo $style_attr; ?>>
	<?php if (!empty($icon_url)) : ?>
		<img class="icon-chip__icon" src="<?php echo esc_url($icon_url); ?>" alt="" />
	<?php endif; ?>
</<?php echo $tag; ?>>
