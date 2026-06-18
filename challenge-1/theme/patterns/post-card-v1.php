<?php
/**
 * Title: Post Card – V1
 * Slug: gw-blocks-theme/post-card-v1
 * Categories: posts
 * Keywords: post, card
 * Description: Compact post card with image, title and excerpt.
 * Block Types: core/post-template
 * Viewport Width: 350
 * Inserter: yes
 */
?>

<!-- wp:query {"queryId":48,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":true},"metadata":{"categories":["posts"],"patternName":"core/query-grid-posts","name":"Grid"}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-featured-image /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|ml","right":"var:preset|spacing|m","bottom":"var:preset|spacing|ml","left":"var:preset|spacing|m"}}},"layout":{"inherit":false}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--ml);padding-right:var(--wp--preset--spacing--m);padding-bottom:var(--wp--preset--spacing--ml);padding-left:var(--wp--preset--spacing--m)"><!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|neutral-500"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"neutral-500","fontSize":"lg"} /-->

<!-- wp:post-excerpt {"moreText":"Read More","excerptLength":20,"fontSize":"sm"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->



