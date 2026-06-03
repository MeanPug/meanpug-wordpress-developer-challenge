<main class="inf-archive inf-practice-areas">
    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('practice-area-card'); ?>>
        <?php if (has_post_thumbnail()) : ?>
        <div class="practice-area-image">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
        </div>
        <?php endif; ?>
        <div class="practice-area-content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="practice-area-excerpt"><?php the_excerpt(); ?></div>
            <a href="<?php the_permalink(); ?>" class="button">Learn More</a>
        </div>
    </article>
    <?php endwhile; ?>
    <?php the_posts_pagination(); ?>
</main>
