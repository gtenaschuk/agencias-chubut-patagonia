<?php
/**
 * ACF Field block.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

$block_id      = $block['id'];
$campo            = get_field( 'campo' );
if ( ! $campo ) {
	$campo            = 'nombre_en_ingles';
}
$valor_campo      = get_field( $campo, get_the_ID() );
if ( 'nombre_en_ingles' === $campo ) {
	echo '<div class="wp-block-post-excerpt"><p class="wp-block-post-excerpt__excerpt">' . esc_html( $valor_campo ) . '</p></div>';
} else if ( 'area' === $campo ) {
	echo '<p class="is-style-prg_suptitel">' . esc_html( $valor_campo ) . '</p>';
} else if ( 'posicion' === $campo ) {
	echo '<p class="wp-block-post-excerpt__excerpt">' . esc_html( $valor_campo ) . '</h6>';
} else {
	echo esc_html( $valor_campo );
}

