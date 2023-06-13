<?php
/**
 * Spacebar Portal Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Spacebar Portal
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_SPACEBAR_PORTAL_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */

function prettyPrint($array) {
	echo '<pre>'.print_r($array, true).'</pre>';
}

function child_enqueue_styles() {

	wp_enqueue_style( 'spacebar-portal-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_SPACEBAR_PORTAL_VERSION, 'all' );
	
	$result = GFAPI::get_form(2);
	$la = GFAPI::duplicate_form( 2 );
	prettyPrint($la);

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );