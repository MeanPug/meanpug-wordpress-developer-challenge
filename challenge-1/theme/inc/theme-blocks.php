<?php
// Editor style setup
add_action('after_setup_theme', 'custom_editor_styles_hub');
function custom_editor_styles_hub() {
	add_theme_support('editor-styles');
	
	add_editor_style('/assets/css/main.css');
	add_editor_style('/assets/css/editor.css');

	// Register block style variations

	// Buttons
	register_block_style('core/button', array(
		'name' => 'secondary-fill',
		'label' => __('Secondary Fill', 'gwblueprint'),
	));

	register_block_style('core/button', array(
		'name' => 'secondary-outline',
		'label' => __('Secondary Outline', 'gwblueprint'),
	));

	register_block_style('core/button', array(
		'name' => 'white-fill',
		'label' => __('White Fill', 'gwblueprint'),
	));

	register_block_style('core/button', array(
		'name' => 'white-outline',
		'label' => __('White Outline', 'gwblueprint'),
	));
}

// Register block categories
add_filter( 'block_categories_all', function( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'		=> 'custom',
				'title'		=> __( 'Custom', 'custom' ),
			)
		)
	);
}, 10, 2);

// Blocks registration
add_action('init', function(){
	if (!function_exists('register_block_type')) {
		return;
	}

	gw_register_block('menu-trigger', array(
		'name'     => __('Menu Trigger', 'gwblueprint'),
		'category' => 'custom',
		'icon'     => 'menu',
		'supports' => array(
			'anchor'          => true,
			'customClassName' => true,
		),
		'render'   => 'menu-trigger/view.php',
	));

	gw_register_block('account-menu', array(
		'name'     => __('Account Menu', 'gwblueprint'),
		'category' => 'custom',
		'icon'     => 'admin-users',
		'supports' => array(
			'anchor'          => true,
			'customClassName' => true,
		),
		'render'   => 'account-menu/view.php',
		'fields'   => array(
			'avatar' => array(
				'type'    => 'string',
				'control' => 'image',
				'label'   => __('Avatar image', 'gwblueprint'),
				'saveAs'  => 'id',
				'default' => '',
			),
		),
	));

	gw_register_block('icon-chip', array(
		'name'     => __('Icon Chip', 'gwblueprint'),
		'category' => 'custom',
		'icon'     => 'admin-links',
		'supports' => array(
			'anchor'          => true,
			'customClassName' => true,
		),
		'render'   => 'icon-chip/view.php',
		'fields'   => array(
			'icon' => array(
				'type'    => 'string',
				'control' => 'image',
				'label'   => __('Icon (SVG)', 'gwblueprint'),
				'saveAs'  => 'url',
				'default' => '',
			),
			'link' => array(
				'type'    => 'string',
				'control' => 'text',
				'label'   => __('Link URL', 'gwblueprint'),
				'default' => '',
			),
			'bg' => array(
				'type'    => 'string',
				'control' => 'color',
				'label'   => __('Background color', 'gwblueprint'),
				'default' => '',
			),
			'bgHover' => array(
				'type'    => 'string',
				'control' => 'color',
				'label'   => __('Background color (hover)', 'gwblueprint'),
				'default' => '',
			),
		),
	));

	gw_register_block('search-bar', array(
		'name'     => __('Search Bar', 'gwblueprint'),
		'category' => 'custom',
		'icon'     => 'search',
		'supports' => array(
			'anchor'          => true,
			'customClassName' => true,
		),
		'render'   => 'search-bar/view.php',
		'fields'   => array(
			'locationLabel'       => array('type' => 'string', 'control' => 'text', 'label' => __('Location label', 'gwblueprint'),       'default' => 'Location'),
			'locationPlaceholder' => array('type' => 'string', 'control' => 'text', 'label' => __('Location placeholder', 'gwblueprint'), 'default' => 'Where are you going?'),
			'checkinLabel'        => array('type' => 'string', 'control' => 'text', 'label' => __('Check in label', 'gwblueprint'),        'default' => 'Check in'),
			'checkinValue'        => array('type' => 'string', 'control' => 'text', 'label' => __('Check in value', 'gwblueprint'),        'default' => 'Add dates'),
			'checkoutLabel'       => array('type' => 'string', 'control' => 'text', 'label' => __('Check out label', 'gwblueprint'),       'default' => 'Check out'),
			'checkoutValue'       => array('type' => 'string', 'control' => 'text', 'label' => __('Check out value', 'gwblueprint'),       'default' => 'Add dates'),
			'guestsLabel'         => array('type' => 'string', 'control' => 'text', 'label' => __('Guests label', 'gwblueprint'),          'default' => 'Guests'),
			'guestsValue'         => array('type' => 'string', 'control' => 'text', 'label' => __('Guests value', 'gwblueprint'),          'default' => 'Add guests'),
			'buttonText'          => array('type' => 'string', 'control' => 'text', 'label' => __('Button text', 'gwblueprint'),           'default' => 'Search'),
			'actionUrl'           => array('type' => 'string', 'control' => 'text', 'label' => __('Search URL (form action)', 'gwblueprint'), 'default' => ''),
		),
		'ui'       => array(
			'tabs' => array(
				array(
					'name'   => 'content',
					'title'  => __('Content', 'gwblueprint'),
					'fields' => array('locationLabel', 'locationPlaceholder', 'checkinLabel', 'checkinValue', 'checkoutLabel', 'checkoutValue', 'guestsLabel', 'guestsValue', 'buttonText'),
				),
				array(
					'name'   => 'settings',
					'title'  => __('Settings', 'gwblueprint'),
					'fields' => array('actionUrl'),
				),
			),
		),
	));

	// --- Tabs (parent) + Tab (child): slider/slide-style InnerBlocks pattern ---
	gw_register_block('tabs', array(
		'name'     => __('Tabs', 'gwblueprint'),
		'category' => 'custom',
		'icon'     => 'table-row-before',
		'supports' => array(
			'anchor'                    => true,
			'customClassName'           => true,
			'__experimentalInnerBlocks' => true,
			'innerBlocks'               => true,
			'align'                     => array('wide', 'full'),
			'spacing'                   => array(
				'margin'  => true,
				'padding' => true,
			),
		),
		// Restrict children to Tab blocks and seed a couple of tabs.
		'allowedBlocks' => array('gw/tab'),
		'template'      => array(
			array('gw/tab', array('title' => 'Tab one')),
			array('gw/tab', array('title' => 'Tab two')),
		),
		'render'   => 'tabs/view.php',
	));

	gw_register_block('tab', array(
		'name'     => __('Tab', 'gwblueprint'),
		'category' => 'custom',
		'icon'     => 'table-col-after',
		'supports' => array(
			'anchor'                    => true,
			'customClassName'           => true,
			'__experimentalInnerBlocks' => true,
			'innerBlocks'               => true,
		),
		// Only insertable inside a Tabs block.
		'parent'   => array('gw/tabs'),
		'render'   => 'tab/view.php',
		'fields'   => array(
			'title' => array(
				'type'    => 'string',
				'control' => 'text',
				'label'   => __('Tab title', 'gwblueprint'),
				'default' => '',
			),
		),
	));
});

// Replace a button link of "#currentpost" with the current post permalink
add_filter('render_block_data', function($parsed_block){
	if (
		isset($parsed_block['blockName']) && $parsed_block['blockName'] === 'core/button' &&
		isset($parsed_block['attrs']['url']) && $parsed_block['attrs']['url'] === '#currentpost'
	){
		$current_id = get_the_ID();
		if (empty($current_id)) {
			$current_id = get_queried_object_id();
		}
		$parsed_block['attrs']['url'] = get_the_permalink($current_id);
	}
	return $parsed_block;
}, 10, 1);

// Fallback: replace in rendered HTML if the attribute is not present but the markup uses the placeholder
add_filter('render_block', function($block_content, $block){
	if (!is_string($block_content) || empty($block_content)) {
		return $block_content;
	}
	if (isset($block['blockName']) && $block['blockName'] === 'core/button') {
		if (strpos($block_content, 'href="#currentpost"') !== false || strpos($block_content, "href='#currentpost'") !== false) {
			$current_id = get_the_ID();
			if (empty($current_id)) {
				$current_id = get_queried_object_id();
			}
			$permalink = esc_url(get_the_permalink($current_id));
			$block_content = str_replace(
				array('href="#currentpost"', "href='#currentpost'"),
				array('href="' . $permalink . '"', "href='" . $permalink . "'"),
				$block_content
			);
		}
	}
	return $block_content;
}, 10, 2);

/**
 * Modify the button block output
 * 
 * Adds CSS custom properties to the button block
 * 
 */
function modify_button_block_render($block_content, $block) {
	// Only modify core/button blocks
	if ($block['blockName'] !== 'core/button') {
		return $block_content;
	}

	// Get the background color from block attributes
	$background_color = isset($block['attrs']['backgroundColor']) ? $block['attrs']['backgroundColor'] : '';
	$text_color = isset($block['attrs']['textColor']) ? $block['attrs']['textColor'] : '';
	$style = isset($block['attrs']['style']) ? $block['attrs']['style'] : '';

	// Create a new HTML tag processor
	$processor = new WP_HTML_Tag_Processor($block_content);

	// Find the button link element
	if ($processor->next_tag('a')) {
		// Get existing style attribute
		$style_attr = $processor->get_attribute('style') ?: '';
		
		// Add the CSS custom properties
		if (!empty($background_color)) {
			$style_attr .= sprintf(';--btnColor: var(--wp--preset--color--%s);', esc_attr($background_color));
		}else if(strpos($style_attr, 'background-color:') !== false){
			$bgcolor = '';
			if (preg_match('/background-color:(#[0-9a-fA-F]{6})/', $style_attr, $matches)) {
				$bgcolor = $matches[1];
				$style_attr = str_replace('background-color:', '--btnColor:', $style_attr);
				$style_attr = $style_attr.';';
			}
		}
		
		if (!empty($text_color)) {
			// Check if it's a preset color or a hex value
			if (strpos($text_color, '#') === 0) {
				$style_attr .= sprintf('--btnTextColor: %s;', esc_attr($text_color));
			} else {
				$style_attr .= sprintf('--btnTextColor: var(--wp--preset--color--%s);', esc_attr($text_color));
			}
		}
		
		// Update the style attribute
		if(!empty($style_attr)){
			$processor->set_attribute('style', $style_attr);
		}
		
		// Remove color classes
		$class = $processor->get_attribute('class') ?: '';
		$class = str_replace(array('-color', 'has-'), '', $class);

		if (!empty($class)) {
			$processor->set_attribute('class', $class);
		} else {
			$processor->remove_attribute('class');
		}
		
		// Return the modified HTML
		return $processor->get_updated_html();
	}

	return $block_content;
}
add_filter('render_block', 'modify_button_block_render', 20, 2);

/*** BLOCK VARIATIONS ***/
function gw_register_group_section_variation($variations, $block_type) {
	// Only modify variations for the group block
	if ('core/group' !== $block_type->name) {
		return $variations;
	}

	// Add a custom variation
	$variations[] = array(
		'name'        => 'section-full',
		'title'       => __('Section', 'gwblueprint'),
		'description' => __('A full-width section with constrained layout and default padding', 'gwblueprint'),
		'scope'       => array('inserter', 'block'),
		'isDefault'   => false,
		'attributes'  => array(
			'tagName' => 'section',
			'align'   => 'full',
			'style'   => array(
				'spacing' => array(
					'padding' => array(
						'top'    => 'var:preset|spacing|xl',
						'bottom' => 'var:preset|spacing|xl',
						'left'   => 'var:preset|spacing|base',
						'right'  => 'var:preset|spacing|base',
					),
					'margin' => array(
						'top'    => '0',
						'bottom' => '0',
					),
				),
			),
			'layout' => array(
				'type' => 'constrained',
			),
		),
	);

	return $variations;
}
add_filter('get_block_type_variations', 'gw_register_group_section_variation', 10, 2);