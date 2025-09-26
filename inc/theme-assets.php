<?php
/**
 * Theme Assets.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

/**
 * Register styles.
 *
 * @since 1.0.0
 */
function dinkuminteractive_register_assets() {

	// Theme style.
	wp_register_style(
		'dinkuminteractive-style',
		get_template_directory_uri() . '/dist/css/style.min.css',
		array(),
		DINKUM_GUTENBERG_V2_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'dinkuminteractive_register_assets' );

/**
 * Register styles.
 *
 * @since 1.0.0
 */
function dinkuminteractive_enqueue_assets() {

	// Enqueue theme stylesheet.
	wp_enqueue_style( 'dinkuminteractive-style' );

	// Editor stylesheet.
	$editor_stylesheet_path = array(
		'/dist/css/style.min.css',
		'/dist/css/editor-style.css',
	);
	add_editor_style( $editor_stylesheet_path );

}
// add_action( 'after_setup_theme', 'dinkuminteractive_enqueue_assets' );
add_action( 'wp_enqueue_scripts', 'dinkuminteractive_enqueue_assets' );

wp_enqueue_script( 'script-name', get_template_directory_uri() . '/dist/js/lib/custom.js', array(), '1.0.0', true );
