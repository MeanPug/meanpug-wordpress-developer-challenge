<?php
/**
 * Single featured card.
 *
 * @package infra
 *
 * @var array $args {
 *     @type string $title
 *     @type string $excerpt
 *     @type string $image
 *     @type string $url
 *     @type string $badge Optional.
 * }
 */

$title   = $args['title'] ?? '';
$excerpt = $args['excerpt'] ?? '';
$image   = $args['image'] ?? '';
$url     = $args['url'] ?? '#';
$badge   = $args['badge'] ?? '';
?>
<li>
    <a href="<?php echo esc_url( $url ); ?>" class="group block <?php echo $badge ? 'relative' : ''; ?>">
        <?php if ( $badge ) : ?>
            <span class="absolute top-3 left-3 z-10 bg-white text-airbnb-text text-[11px] font-extrabold tracking-wider px-1.5 py-0.5 rounded shadow-sm">
                <?php echo esc_html( $badge ); ?>
            </span>
        <?php endif; ?>
        <div class="w-full aspect-[16/11] rounded-xl bg-cover bg-center bg-gray-200 mb-3.5 hover:scale-105 transition-transform"
             style="background-image:url('<?php echo esc_url( $image ); ?>');"></div>
        <h2 class="text-xl font-bold leading-tight tracking-tight mb-1"><?php echo esc_html( $title ); ?></h2>
        <p class="text-sm text-airbnb-muted"><?php echo esc_html( $excerpt ); ?></p>
    </a>
</li>