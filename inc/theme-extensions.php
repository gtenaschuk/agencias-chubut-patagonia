<?php
/**
 * Theme extensions
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */


$dinkuminteractive_extensions_dir = get_template_directory() . '/inc/extensions';

// Add ACF support.
if ( class_exists( 'ACF' ) ) {
	require_once "$dinkuminteractive_extensions_dir/acf.php";
}

// Add WooCommerce support.
if ( class_exists( 'WooCommerce' ) ) {
	require_once "$dinkuminteractive_extensions_dir/woocommerce.php";
}

// Add GF support.
if ( class_exists( 'GFForms' ) ) {
	require_once "$dinkuminteractive_extensions_dir/gf.php";
}
