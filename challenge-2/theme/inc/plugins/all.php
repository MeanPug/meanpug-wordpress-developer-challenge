<?php
/**
 * Recommends production plugins and shows an admin notice if any are missing.
 *
 * @package PugPuggle
 */

add_action('admin_init', 'pug_check_recommended_plugins');
function pug_check_recommended_plugins() {
    if (!current_user_can('activate_plugins')) {
        return;
    }

    $plugins = [
        [
            'slug'    => 'advanced-custom-fields/acf.php',
            'name'    => 'Advanced Custom Fields (ACF)',
            'purpose' => 'Enables custom fields and meta boxes for all content types.',
        ],
        [
            'slug'    => 'contact-form-7/wp-contact-form-7.php',
            'name'    => 'Contact Form 7',
            'purpose' => 'Creates and manages multiple contact forms with Ajax support.',
        ],
        [
            'slug'    => 'wordpress-seo/wp-seo.php',
            'name'    => 'Yoast SEO',
            'purpose' => 'Optimizes meta tags, generates XML sitemaps, and improves content readability.',
        ],
        [
            'slug'    => 'redirection/redirection.php',
            'name'    => 'Redirection',
            'purpose' => 'Manages 301 redirects, tracks 404 errors, and keeps URL structure clean.',
        ],
        [
            'slug'    => 'wp-super-cache/wp-cache.php',
            'name'    => 'WP Super Cache',
            'purpose' => 'Generates static HTML pages to drastically improve site speed.',
        ],
        [
            'slug'    => 'wordfence/wordfence.php',
            'name'    => 'Wordfence Security',
            'purpose' => 'Provides firewall, malware scanning, and brute-force login protection.',
        ],
        [
            'slug'    => 'updraftplus/updraftplus.php',
            'name'    => 'UpdraftPlus Backup',
            'purpose' => 'Schedules automatic backups and stores them in remote locations (cloud).',
        ],
    ];

    $missing = [];
    foreach ($plugins as $plugin) {
        if (!is_plugin_active($plugin['slug'])) {
            $missing[] = $plugin;
        }
    }

    if (!empty($missing)) {
        set_transient('pug_missing_plugins', $missing, HOUR_IN_SECONDS);
        add_action('admin_notices', 'pug_missing_plugins_notice');
    }
}

function pug_missing_plugins_notice() {
    $missing = get_transient('pug_missing_plugins');
    if (!$missing || !is_array($missing)) {
        return;
    }
    ?>
    <div class="notice notice-warning is-dismissible">
        <p>
            <strong>Pug & Puggle Theme:</strong> 
            The following recommended plugins are missing or inactive. 
            Each plays a specific role in the site’s functionality, security, or performance.
        </p>
        <ul style="list-style: disc; padding-left: 20px; margin-top: 5px;">
            <?php foreach ($missing as $plugin) : ?>
                <li>
                    <strong><?php echo esc_html($plugin['name']); ?></strong>
                    — <?php echo esc_html($plugin['purpose']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p>
            Please install and activate them from the 
            <a href="<?php echo esc_url(admin_url('plugins.php')); ?>">Plugins page</a>.
        </p>
    </div>
    <?php
    delete_transient('pug_missing_plugins');
}