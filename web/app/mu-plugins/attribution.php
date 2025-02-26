<?php
/**
 * Plugin Name:     Attribution
 * Description:     Registers attribution HTML Element.
 * Author:          Shrewd Sheep
 * Author URI:      https://shrewdsheep.com
 */

/**
 * Add the element like so:
 * ========================
 * <shrewd-sheep-attribution text="light" link="light" />
 * OR
 * <shrewd-sheep-attribution text="dark" link="dark" />
 */

add_action( "wp_enqueue_scripts", function () {
    wp_register_script( "shrewd-sheep-attribution", "https://shrewdsheep.com/js/attribution.js", [], "1.0", true /* in footer */);
    wp_enqueue_script( "shrewd-sheep-attribution");
});

add_filter("script_loader_tag", function ($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ("shrewd-sheep-attribution" !== $handle ) {
        return $tag;
    }

    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}, 10, 3);