<?php
/**
 * Plugin Name:     Login Logo
 * Description:     Adds the site logo to the WP login page.
 * Author:          Shrewd Sheep
 * Author URI:      https://shrewdsheep.com
 */

add_filter( "login_headerurl", function () {
    return home_url();
});

add_action( "login_enqueue_scripts", function () {
    $logo = get_theme_mod( "custom_logo" );
    $logo_image = wp_get_attachment_image_src( $logo , "full" );
    $logo_url = $logo_image[0];

    ?>
        <style>
            #login h1 a, .login h1 a {
                background-image: url("<?= $logo_url ?>");
                height: 250px;
                width: auto;
                background-size: contain;
                background-repeat: no-repeat;
            }
        </style>
    <?php
});