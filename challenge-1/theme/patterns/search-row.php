<?php
return [
    'title'      => __( 'Search Form Row', 'infra' ),
    'categories' => [ 'meanpug' ],
    'content'    => '<!-- wp:group {"className":"airpnp-search-row","style":{"spacing":{"padding":{"top":"0.5rem","bottom":"0.5rem","left":"0.5rem","right":"0.5rem"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group airpnp-search-row" style="padding-top:0.5rem;padding-right:0.5rem;padding-bottom:0.5rem;padding-left:0.5rem"><!-- wp:search {"label":"Location","placeholder":"Where are you going?","width":33,"widthUnit":"%","buttonText":"Search","buttonPosition":"no-button"} /-->

    <!-- wp:search {"label":"Check in / check out","placeholder":"Add dates","width":33,"widthUnit":"%","buttonText":"Search","buttonPosition":"no-button"} /-->

    <!-- wp:search {"label":"Guests","placeholder":"Add guests","buttonText":"Search"} /--></div>
    <!-- /wp:group -->',
];
