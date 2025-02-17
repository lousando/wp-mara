<?php
/**
 * Plugin Name:     Login Loop
 * Description:     Patches the login loop issue on a Bedrock installation.
 * Author:          Shrewd Sheep
 * Author URI:      https://shrewdsheep.com
 */

add_action("init", function () {
    if ( is_admin() && ! is_user_logged_in() && ! defined("DOING_AJAX") ) {
        wp_redirect( home_url("/wp/wp-login.php") ); // Redirect to your custom login page or wherever you want
        exit;
    }
});
