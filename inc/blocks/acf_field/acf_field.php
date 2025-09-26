<?php
/**
 * ACF Field Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$campo            = get_field( 'campo' );
var_dump($campo);
$valor_campo      = get_field( $campo );
var_dump($valor_campo);
echo esc_html( $valor_campo );
