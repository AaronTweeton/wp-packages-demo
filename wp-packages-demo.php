<?php

/**
 * Plugin Name: WordPress Packages Demo
 * Description: A plugin solely written to show how @wordpress packages can be used.
 * Version:     0.1.0
 * Author:      Aaron Tweeton
 * Author URI:  https://aarontweeton.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/*
WordPress Packages Demo is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

WordPress Packages Demo is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with WordPress Packages Demo. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

function wp_packages_demo_compose_menu_page() {
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div id="app"></div>
    </div>
<?php
}

/**
 * Creates admin page.
 * 
 * @since 0.1.0
 */
function wp_packages_demo_create_page() {
    add_menu_page(
        'WordPress Packages Demo',
        'WP Packages',
        'manage_options',
        'wp-packages',
        'wp_packages_demo_compose_menu_page',
        'dashicons-carrot',
    );
}

/**
 * Enqueue assets.
 * 
 * @since 0.1.0
 */
function wp_packages_enqueue_assets(string $hook) {

    if ('toplevel_page_wp-packages' !== $hook) {
        return;
    }

    $handle = 'wp-packages-demo';
    $filename = plugin_dir_path(__FILE__) . 'build/index.asset.php';

    /**
     * Checks to see if webpack-generated file exists, otherwise sends an error to the console. 
     */
    if (file_exists($filename)) {
        $asset_file = require_once $filename;

        wp_enqueue_script(
            $handle,
            plugins_url('build/index.js', __FILE__),
            $asset_file['dependencies'],
            $asset_file['version'],
            true
        );
    } else {
        wp_register_script($handle, '',);
        wp_enqueue_script($handle);
        wp_add_inline_script($handle, "console.error('" . __("A required file could not be loaded, which will prevent some content from loading.", 'admin-style-book') . "');");
    }
}

add_action('admin_menu', 'wp_packages_demo_create_page');
add_action('admin_enqueue_scripts', 'wp_packages_enqueue_assets');
