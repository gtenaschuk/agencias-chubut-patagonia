<?php
/**
 * ACF Support.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

/**
 * Acf option page.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
	acf_add_options_sub_page( 'Options' );
	acf_add_options_sub_page( 'Block Options' );
	acf_add_options_sub_page( 'Advanced' );
}

/**
 * ACF Display Custom Fields
 */
add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );
