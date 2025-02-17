<?php
/**
 * Plugin Name:     Security
 * Description:     Locks down a Wordpress website.
 * Author:          Shrewd Sheep
 * Author URI:      https://shrewdsheep.com
 */

// Disable all xml-rpc endpoints
add_filter("xmlrpc_methods", function () {
    return [];
}, PHP_INT_MAX);

// generators
remove_action("wp_head", "wp_generator");
remove_action("wp_head", "webp_uploads_render_generator");

// discovery links
remove_action("wp_head", "rest_output_link_wp_head");
remove_action("wp_head", "wp_oembed_add_discovery_links");
remove_action("wp_head", "rsd_link");
remove_action("wp_head", "wlwmanifest_link");
remove_action("wp_head", "wp_shortlink_wp_head");

// relational post links
remove_action("wp_head", "start_post_rel_link");
remove_action("wp_head", "index_rel_link");
remove_action("wp_head", "adjacent_posts_rel_link");

/*
 * Completely Disable Comments
 * =============================
 */
add_action("admin_init", function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === "edit-comments.php") {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box("dashboard_recent_comments", "dashboard", "normal");

    remove_action("admin_bar_menu", "wp_admin_bar_comments_menu", 60 );

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, "comments")) {
            remove_post_type_support($post_type, "comments");
            remove_post_type_support($post_type, "trackbacks");
        }
    }
});

// Close comments on the front-end
add_filter("comments_open", "__return_false", 20, 2);
add_filter("pings_open", "__return_false", 20, 2);

// Hide existing comments
add_filter("comments_array", "__return_empty_array", 10, 2);

// Remove comments page in menu
add_action("admin_menu", function () {
    remove_menu_page("edit-comments.php");
});

// Remove comments links from admin bar
add_action("init", function () {
    if (is_admin_bar_showing()) {
        remove_action("admin_bar_menu", "wp_admin_bar_comments_menu", 60);
    }
});