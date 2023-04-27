<?php

/**
 * Plugin Name: WordPress Packages Demo
 * Description: A plugin solely written to show how @wordpress packages can be used.
 * Version: 0.1.0
 * Author: Aaron Tweeton
 * Author URI: https://aarontweeton.com
 */

function wp_packages_demo_compose_menu_page() {
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div id="app"></div>
    </div>
<?php
}


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

function wp_packages_enqueue_assets(string $hook) {
    if ('toplevel_page_wp-packages' !== $hook) {
        return;
    }

    wp_enqueue_script(
        'wp-packages-demo',
        plugins_url('index.js', __FILE__),
    );
}

add_action('admin_menu', 'wp_packages_demo_create_page');
add_action('admin_enqueue_scripts', 'wp_packages_enqueue_assets');
