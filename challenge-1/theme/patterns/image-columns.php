<?php
return [
    'title'      => __( 'Image Columns', 'infra' ),
    'categories' => [ 'meanpug' ],
    'content'    => '<!-- wp:columns {"align":"wide","className":"airpnp-image-columns"} -->
    <div class="wp-block-columns alignwide airpnp-image-columns">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"id":34,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full">
                <img src="http://localhost:8000/wp-content/uploads/2024/12/airpnp1.png" alt="" class="wp-image-34" style="aspect-ratio:4/3;object-fit:cover"/>
            </figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"id":36,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full">
                <img src="http://localhost:8000/wp-content/uploads/2024/12/airpnp2.png" alt="" class="wp-image-36" style="aspect-ratio:4/3;object-fit:cover"/>
            </figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"id":35,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full">
                <img src="http://localhost:8000/wp-content/uploads/2024/12/airpnp3.png" alt="" class="wp-image-35" style="aspect-ratio:4/3;object-fit:cover"/>
            </figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->',
];
