<?php
$subtitle = get_field('page_subtitle') ?: '';
?>
<header class="page-header">
    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    <h1 class="page-title"><?php the_title(); ?></h1>
    <?php if ($subtitle) : ?>
    <p class="page-subtitle"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
</header>
