<?php
return [
    'title'      => __( 'Hero Callout Grid', 'infra' ),
    'categories' => [ 'meanpug' ],
    'content'    => '<!-- wp:group {"align":"full","className":"airpnp-hero-callout-grid","style":{"color":{"background":"#000000"},"spacing":{"padding":{"top":"6rem","left":"3rem","right":"3rem","bottom":"3rem"}}},"textColor":"white","layout":{"type":"grid","minimumColumnWidth":"15rem"}} -->
    <div class="wp-block-group alignfull airpnp-hero-callout-grid has-white-color has-text-color has-background" style="background-color:#000000;padding-top:6rem;padding-left:3rem;padding-right:3rem;padding-bottom:3rem">
        <!-- wp:group {"style":{"layout":{"columnSpan":1}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group">
            <!-- wp:heading {"style":{"typography":{"fontWeight":"600","fontStyle":"normal","lineHeight":"1"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"large"} -->
            <h2 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size" style="font-style:normal;font-weight:600;line-height:1">We stand with #BlackLivesMatter</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
            <p class="has-white-color has-text-color has-link-color" style="font-size:16px">Now more than ever, it’s important that you know how we’re fighting discrimination on Airbnb. We’d like to share our newest initiative with you, Project Lighthouse.</p>
            <!-- /wp:paragraph -->

            <!-- wp:button {"textAlign":"center","backgroundColor":"black","textColor":"white","className":"is-style-fill","style":{"border":{"radius":"0px"},"spacing":{"padding":{"top":"0rem","left":"0rem","right":"0rem","bottom":"0rem"}}}} -->
            <div class="wp-block-button is-style-fill">
                <a class="wp-block-button__link has-white-color has-black-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:0px;padding-top:0rem;padding-left:0rem;padding-right:0rem;padding-bottom:0rem">Learn more</a>
            </div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->',
];
