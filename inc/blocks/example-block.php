<?php
/**
 * Example block.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

$block_id      = $block['id'];
$example_field = get_field( 'example_field' );

echo esc_html_e( 'Example Field', 'dinkuminteractive' );
