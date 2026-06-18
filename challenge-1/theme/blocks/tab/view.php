<?php
/**
 * Block: GW Tab (child of gw/tabs)
 *
 * Holds the content of a single tab as InnerBlocks. Its `title` attribute is
 * read by the parent Tabs block to build the navigation; the parent wraps this
 * output in the active-aware panel, so here we only emit the inner content.
 *
 * @var array     $attributes
 * @var string    $content
 * @var WP_Block  $block
 */

// InnerBlocks fallback (same safety net as gw-core Slide).
if (empty($content) && !empty($block)) {
	if (isset($block->inner_blocks) && !empty($block->inner_blocks)) {
		$content = '';
		foreach ($block->inner_blocks as $inner_block) {
			$content .= $inner_block->render();
		}
	} elseif (isset($block->inner_content) && !empty($block->inner_content)) {
		$content = '';
		foreach ($block->inner_content as $chunk) {
			if (is_string($chunk)) {
				$content .= $chunk;
			} elseif (isset($chunk->parsed_block)) {
				$content .= render_block($chunk->parsed_block);
			}
		}
	}
}

echo $content;
