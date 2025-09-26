<?php
/**
 * Theme Blocks.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

 function custom_editor_scripts() {
    wp_enqueue_script(
        'dinkuminteractive-extend-post-template',
        get_template_directory_uri() . '/js/extend-post-template.js',
        array( 'wp-blocks', 'wp-element', 'wp-hooks', 'wp-editor', 'wp-data', 'wp-core-data' ),
        '1.0.0',
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'custom_editor_scripts' );

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function di_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */

	$status = register_block_type( __DIR__ . '/blocks/acf_field/block.json' ); // block.json not needed
    // If register_block_type cannot register the block, it returns false

}
// Here we call our tt3child_register_acf_block() function on init.
add_action( 'init', 'di_register_acf_blocks' );


/**
 * Register blocks categories
 *
 * @param array                   $categories  Param categories.
 * @param WP_Block_Editor_Context $post        Param post.
 * @return array
 */
function dinkuminteractive_block_category( $categories, $post ) {

	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'basicpage-block',
				'title' => __( 'Custom basic page blocks', 'dinkuminteractive' ),
			),
		)
	);
}
add_filter( 'block_categories_all', 'dinkuminteractive_block_category', 10, 2 );

/**
 * Register block types
 */
function dinkuminteractive_acf_block_types() {
	acf_register_block_type(
		array(
			'name'            => 'acf-field-block',
			'title'           => __( 'Field Block', 'dinkuminteractive' ),
			'description'     => __( 'Muestra datos de campos', 'dinkuminteractive' ),
			'render_template' => 'inc/blocks/acf-field-block.php',
			'category'        => 'basicpage-block',
			'icon'            => 'format-aside',
			'keywords'        => array( 'field' ),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'acf-calendario-fauna',
			'title'           => __( 'Calendario de Fauna', 'dinkuminteractive' ),
			'description'     => __( 'Muestra el calendario de fauna', 'dinkuminteractive' ),
			'render_template' => 'inc/blocks/acf-calendario-de-fauna.php',
			'category'        => 'schedule',
			'icon'            => 'schedule',
			'keywords'        => array( 'schedule' ),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'acf-calendario-mareas',
			'title'           => __( 'Calendario de Mareas', 'dinkuminteractive' ),
			'description'     => __( 'Muestra el calendario de mareas', 'dinkuminteractive' ),
			'render_template' => 'inc/blocks/acf-calendario-de-mareas.php',
			'category'        => 'schedule',
			'icon'            => 'schedule',
			'keywords'        => array( 'schedule' ),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'acf-impresion-hoja-ruta',
			'title'           => __( 'Impresión Hoja de ruta', 'dinkuminteractive' ),
			'description'     => __( 'Impresión Hoja de ruta', 'dinkuminteractive' ),
			'render_template' => 'inc/blocks/acf-impresion-hoja-ruta.php',
			'category'        => 'print',
			'icon'            => 'print',
			'keywords'        => array( 'print' ),
		)
	);
}

// Check if function exists and hook into setup.
if ( function_exists( 'acf_register_block_type' ) ) {
	add_action( 'acf/init', 'dinkuminteractive_acf_block_types' );
}
