<?php
/**
 * List of custom post type register functions
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */



/**
 * Modify default posts post type.
 *
 * @param array  $args         Post arguments.
 * @param string $post_type    The post type name.
 *
 * @return array Array of built in post arguments.
 */
function dinkuminteractive_change_default_post( $args, $post_type ) {
	if ( 'post' === $post_type ) {
		$args['labels']        = array(
			'name'               => _x( 'Artículos', 'Artículos', 'dinkuminteractive' ),
			'singular_name'      => _x( 'Artículo', 'Artículo', 'dinkuminteractive' ),
			'menu_name'          => __( 'Artículos', 'dinkuminteractive' ),
			'parent_item_colon'  => __( 'Artículo Padre', 'dinkuminteractive' ),
			'all_items'          => __( 'Todos los Artículos', 'dinkuminteractive' ),
			'view_item'          => __( 'Ver Artículo', 'dinkuminteractive' ),
			'add_new_item'       => __( 'Agregar Artículo', 'dinkuminteractive' ),
			'add_new'            => __( 'Agregar nuevo', 'dinkuminteractive' ),
			'edit_item'          => __( 'Editar Artículo', 'dinkuminteractive' ),
			'update_item'        => __( 'Actualizar Artículo', 'dinkuminteractive' ),
			'search_items'       => __( 'Buscar Artículo', 'dinkuminteractive' ),
			'not_found'          => __( 'No Encontrado', 'dinkuminteractive' ),
			'not_found_in_trash' => __( 'No encontrado en papelera', 'dinkuminteractive' ),
		);
		$args['menu_position'] = 32;
		$args['menu_icon']     = 'dashicons-clock';
	}

	return $args;
}
add_filter( 'register_post_type_args', 'dinkuminteractive_change_default_post', 20, 2 );
