<?php
/**
 * Block: GW Tabs (parent)
 *
 * Parent block whose children are Tab blocks. It builds the tab navigation
 * from each child's `title` attribute and wraps each child's inner content in
 * a panel. The first tab/panel is marked active server-side; a shared script
 * (printed once per page) switches the active tab on click.
 *
 * Mirrors the gw-core Slider/Slide parent–child pattern, but for tabs.
 *
 * @var array     $attributes
 * @var string    $content
 * @var WP_Block  $block
 */

// Collect children: title (for the nav) + rendered inner content (for the panel).
$gw_tabs = array();
if (!empty($block) && isset($block->inner_blocks) && !empty($block->inner_blocks)) {
	$idx = 0;
	foreach ($block->inner_blocks as $child) {
		$attrs = isset($child->attributes) ? $child->attributes : array();
		$title = (isset($attrs['title']) && $attrs['title'] !== '')
			? $attrs['title']
			: sprintf(__('Tab %d', 'gwblueprint'), $idx + 1);
		$gw_tabs[] = array(
			'title' => $title,
			'html'  => $child->render(),
		);
		$idx++;
	}
}

// Nothing to render without children.
if (empty($gw_tabs)) {
	return;
}

static $gw_tabs_seq = 0;
$uid = 'gw_tabs_' . (++$gw_tabs_seq);

$wrapper_attributes = get_block_wrapper_attributes(array(
	'class' => 'gw-tabs',
	'id'    => $uid,
));

// Shared init script — printed once per page (delegated, handles every instance).
static $gw_tabs_assets_printed = false;
?>
<?php if (!$gw_tabs_assets_printed) : $gw_tabs_assets_printed = true; ?>
<?php if (!is_admin()) : ?>
<script id="gw-tabs-init">
(function () {
	function activate(root, index) {
		var tabs   = root.querySelectorAll(':scope > .gw-tabs__nav > .gw-tabs__tab');
		var panels = root.querySelectorAll(':scope > .gw-tabs__panels > .gw-tabs__panel');
		for (var i = 0; i < tabs.length; i++) {
			var on = (i === index);
			tabs[i].classList.toggle('is-active', on);
			tabs[i].setAttribute('aria-selected', on ? 'true' : 'false');
		}
		for (var j = 0; j < panels.length; j++) {
			panels[j].classList.toggle('is-active', j === index);
		}
	}
	document.addEventListener('click', function (e) {
		var btn = e.target.closest ? e.target.closest('.gw-tabs__tab') : null;
		if (!btn) { return; }
		var root = btn.closest('.gw-tabs');
		if (!root) { return; }
		e.preventDefault();
		var idx = parseInt(btn.getAttribute('data-gw-tab'), 10);
		if (isNaN(idx)) { idx = 0; }
		activate(root, idx);
	});
})();
</script>
<?php endif; ?>
<?php endif; ?>

<div <?php echo $wrapper_attributes; ?>>
	<div class="gw-tabs__nav" role="tablist">
		<?php foreach ($gw_tabs as $i => $tab) : ?>
			<button type="button" class="gw-tabs__tab<?php echo 0 === $i ? ' is-active' : ''; ?>" data-gw-tab="<?php echo (int) $i; ?>" role="tab" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"><?php echo esc_html($tab['title']); ?></button>
		<?php endforeach; ?>
	</div>
	<div class="gw-tabs__panels">
		<?php foreach ($gw_tabs as $i => $tab) : ?>
			<div class="gw-tabs__panel<?php echo 0 === $i ? ' is-active' : ''; ?>" data-gw-panel="<?php echo (int) $i; ?>" role="tabpanel"><?php echo $tab['html']; ?></div>
		<?php endforeach; ?>
	</div>
</div>
