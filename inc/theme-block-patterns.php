<?php
/**
 * Theme Patterns.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

/**
 * Registers block patterns and categories.
 *
 * @since 1.0.0
 *
 * @return void
 */
function dinkuminteractive_register_block_categories() {

	$block_pattern_categories = array(
		'featured' => array( 'label' => __( 'Featured', 'dinkuminteractive' ) ),
		'footer'   => array( 'label' => __( 'Footers', 'dinkuminteractive' ) ),
		'header'   => array( 'label' => __( 'Headers', 'dinkuminteractive' ) ),
		'query'    => array( 'label' => __( 'Query', 'dinkuminteractive' ) ),
		'pages'    => array( 'label' => __( 'Pages', 'dinkuminteractive' ) ),
		'columnas' => array( 'label' => __( 'Columnas', 'dinkuminteractive' ) ),
		'slider'   => array( 'label' => __( 'Sliders', 'dinkuminteractive' ) ),
		'banner'   => array( 'label' => __( 'banners', 'dinkuminteractive' ) ),
	);

	$block_pattern_categories = apply_filters( 'dinkuminteractive_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}
}
add_action( 'init', 'dinkuminteractive_register_block_categories', 9 );


/**
 * Remove default block pattern.
 */
remove_theme_support( 'core-block-patterns' );
