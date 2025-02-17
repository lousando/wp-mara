<?php
/**
 * Mara Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mara
 */

add_action( 'wp_enqueue_scripts', 'hello_elementor_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function hello_elementor_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'hello-elementor-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'mara-style',
		get_stylesheet_directory_uri() . '/style.css',
		[ 'hello-elementor-style' ]
	);
}


