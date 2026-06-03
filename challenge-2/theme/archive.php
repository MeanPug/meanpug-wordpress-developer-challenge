<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package infra
 */

get_header();
?>
	<div id="primary" class="content-area">
        <?php
        $post_type = get_post_type();
        $template = locate_template("template-parts/archives/content-{$post_type}.php");
        $slug = $template ? $post_type : 'default';
        get_template_part('template-parts/archives/content', $slug);
        ?>
	</div><!-- #primary -->

<?php
get_footer();
