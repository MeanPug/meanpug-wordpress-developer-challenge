<?php
/**
 * Template Name: Practice Areas
 */
get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <h1>Practice Areas</h1>

            <?php
            $practice_areas = get_posts(array(
                'post_type'      => 'practice_area',
                'posts_per_page' => -1,
            ));

            if ($practice_areas) :
                foreach ($practice_areas as $post) :
                    setup_postdata($post);

                    $name       = get_field('practice_area_name', $post->ID);
                    $slogan     = get_field('slogan', $post->ID);
                    $hero       = get_field('hero_image', $post->ID);
                    $video      = get_field('videotestimonial', $post->ID);
                    $attorneys  = get_field('attorneys', $post->ID);
                    ?>

                    <div style="border: 1px solid #ccc; margin: 20px 0; padding: 20px;">

                        <h2><?php echo $name ?: $post->post_title; ?></h2>

                        <?php if ($slogan) : ?>
                            <p><em><?php echo $slogan; ?></em></p>
                        <?php endif; ?>

                        <?php if ($hero) : ?>
                            <img src="<?php echo $hero['url']; ?>" alt="<?php echo $hero['alt']; ?>" style="max-width: 400px;">
                        <?php endif; ?>

                        <?php if ($post->post_content) : ?>
                            <div><?php echo wpautop($post->post_content); ?></div>
                        <?php endif; ?>

                        <?php if ($attorneys) : ?>
                            <h3>Attorneys</h3>
                            <?php foreach ($attorneys as $attorney) : ?>
                                <div style="margin: 10px 0; padding: 10px; background: #f9f9f9;">
                                    <?php if ($attorney['attorney_photo']) : ?>
                                        <img src="<?php echo $attorney['attorney_photo']['url']; ?>" alt="<?php echo $attorney['attorney_name']; ?>" style="width: 80px; height: 80px; object-fit: cover;">
                                    <?php endif; ?>
                                    <p><strong><?php echo $attorney['attorney_name']; ?></strong></p>
                                    <p><?php echo $attorney['attorney_role']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($video) : ?>
                            <p><strong>Video:</strong> <a href="<?php echo $video; ?>" target="_blank"><?php echo $video; ?></a></p>
                        <?php endif; ?>

                    </div>

                <?php
                endforeach;
                wp_reset_postdata();
            else :
                echo '<p>No practice areas found.</p>';
            endif;
            ?>

        </main>
    </div>

<?php
get_sidebar();
get_footer();