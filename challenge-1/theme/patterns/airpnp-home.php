<?php
return [
    'title'      => __( 'AirPnP Home', 'infra' ),
    'categories' => [ 'meanpug' ],
    'content'    => '<!-- wp:navigation {"ref":10,"overlayMenu":"never"} /-->

<!-- wp:group {"metadata":{"patternName":"/theme/patterns/search-row","name":"Search Form Row"},"className":"airpnp-search-row","style":{"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"0.5rem","right":"0.5rem"},"borderRadius":"8px"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group airpnp-search-row" style="padding-top:0.5rem;padding-right:0.5rem;padding-bottom:0.5rem;padding-left:0.5rem"><!-- wp:search {"label":"Location","placeholder":"Where are you going?","width":33,"widthUnit":"%","buttonText":"Search","buttonPosition":"no-button"} /-->

<!-- wp:search {"label":"Check in / check out","placeholder":"Add dates","width":33,"widthUnit":"%","buttonText":"Search","buttonPosition":"no-button"} /-->

<!-- wp:search {"label":"Guests","placeholder":"Add guests","buttonText":"Search"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"patternName":"/theme/patterns/hero-callout-grid","name":"Hero Callout Grid"},"align":"full","className":"airpnp-hero-callout-grid","style":{"color":{"background":"#000000"},"spacing":{"padding":{"top":"6rem","left":"3rem","right":"3rem","bottom":"3rem"}}},"textColor":"white","layout":{"type":"grid","minimumColumnWidth":"15rem"}} -->
<div class="wp-block-group alignfull airpnp-hero-callout-grid has-white-color has-text-color has-background" style="background-color:#000000;padding-top:6rem;padding-right:3rem;padding-bottom:3rem;padding-left:3rem"><!-- wp:group {"style":{"layout":{"columnSpan":1}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"fontWeight":"600","fontStyle":"normal","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"large"} -->
<h2 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size" style="font-style:normal;font-weight:600;line-height:1">We stand with #BlackLivesMatter</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
<p class="has-white-color has-text-color has-link-color" style="font-size:16px">Now more than ever, it’s important that you know how we’re fighting discrimination on Airbnb. We’d like to share our newest initiative with you, Project Lighthouse.</p>
<!-- /wp:paragraph -->

<!-- wp:button {"textAlign":"center","backgroundColor":"black","textColor":"white","className":"is-style-fill","style":{"border":{"radius":"0px"},"spacing":{"padding":{"top":"0rem","left":"0rem","right":"0rem","bottom":"0rem"}}}} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-white-color has-black-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:0px;padding-top:0rem;padding-right:0rem;padding-bottom:0rem;padding-left:0rem">Learn more</a></div>
<!-- /wp:button --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:columns {"metadata":{"patternName":"/theme/patterns/image-columns","name":"Image Columns"},"align":"wide","className":"airpnp-image-columns"} -->
<div class="wp-block-columns alignwide airpnp-image-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":34,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="/wp-content/themes/theme/assets/img/airpnp1.png" alt="Image of an AirPnP listing 1" class="wp-image-34" style="aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":36,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="/wp-content/themes/theme/assets/img/airpnp2.png" alt="Image of an AirPnP listing 2" class="wp-image-36" style="aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":35,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="/wp-content/themes/theme/assets/img/airpnp3.png" alt="Image of an AirPnP listing 3" class="wp-image-35" style="aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
];
