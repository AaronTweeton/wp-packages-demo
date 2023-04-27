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

add_action('admin_menu', 'wp_packages_demo_create_page');
