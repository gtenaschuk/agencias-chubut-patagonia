<?php
/**
 * Theme Menu.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

/**
 * Register theme menu.
 */
function dinkuminteractive_register_menu() {
	register_nav_menus(
		array(
			'main_menu'   => __( 'Main Menu', 'dinkuminteractive' ),
			'footer_menu' => __( 'Footer Menu', 'dinkuminteractive' ),
		)
	);
}
add_action( 'init', 'dinkuminteractive_register_menu' );
