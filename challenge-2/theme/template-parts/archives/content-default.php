<?php
?>
<main class="inf-archive inf-archive-<?php echo esc_attr(get_post_type()); ?>">
    <header class="page-header">
        <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        the_archive_description('<div class="archive-description">', '</div>');
        ?>
    </header>

    <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
        </a>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    </article>
    <?php endwhile; ?>

    <?php the_posts_navigation(); ?>
</main>
