<?php
/**
 * Theme functions and definitions
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

// Constants.
define( 'DINKUM_GUTENBERG_V2_VERSION', '1.2.5' );

// Theme Support.
require_once 'inc/theme-support.php';

// Theme Post Types.
require_once 'inc/theme-post-types.php';

// Extension Support.
require_once 'inc/theme-extensions.php';

// Theme Menu.
require_once 'inc/theme-menu.php';

// Theme Blocks.
require_once 'inc/theme-blocks.php';

// Theme Patterns.
require_once 'inc/theme-block-patterns.php';

// Theme Assets.
require_once 'inc/theme-assets.php';

/**
 * Register People People. memo creo que podemos borrar yo solo estaba probando.
 */
// function dinkuminteractive_people_cpt_register() {

// 	$labels = array(
// 		'name'               => _x( 'People', 'People', 'dinkuminteractive' ),
// 		'singular_name'      => _x( 'Person', 'Person', 'dinkuminteractive' ),
// 		'menu_name'          => __( 'People', 'dinkuminteractive' ),
// 		'parent_item_colon'  => __( 'Parent Person', 'dinkuminteractive' ),
// 		'all_items'          => __( 'All People', 'dinkuminteractive' ),
// 		'view_item'          => __( 'View Person', 'dinkuminteractive' ),
// 		'add_new_item'       => __( 'Add Person', 'dinkuminteractive' ),
// 		'add_new'            => __( 'Add New', 'dinkuminteractive' ),
// 		'edit_item'          => __( 'Edit Person', 'dinkuminteractive' ),
// 		'update_item'        => __( 'Update Person', 'dinkuminteractive' ),
// 		'search_items'       => __( 'Search People', 'dinkuminteractive' ),
// 		'not_found'          => __( 'Not Found', 'dinkuminteractive' ),
// 		'not_found_in_trash' => __( 'Not found in Trash', 'dinkuminteractive' ),
// 	);

// 	$args = array(
// 		'label'               => __( 'People', 'dinkuminteractive' ),
// 		'description'         => __( 'Listing of People post type.', 'dinkuminteractive' ),
// 		'labels'              => $labels,
// 		'hierarchical'        => false,
// 		'public'              => true,
// 		'show_ui'             => true,
// 		'show_in_menu'        => true,
// 		'show_in_nav_menus'   => true,
// 		'show_in_admin_bar'   => true,
// 		'menu_position'       => 32,
// 		'show_in_rest'        => true,
// 		'menu_icon'           => 'dashicons-businessman',
// 		'can_export'          => true,
// 		'has_archive'         => false,
// 		'rewrite'             => array(
// 			'slug'       => 'people',
// 			'with_front' => false,
// 		),
// 		'exclude_from_search' => false,
// 		'publicly_queryable'  => true,
// 		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
// 		'capability_type'     => 'page',
// 	);

// 	register_post_type( 'people', $args );

// }
// add_action( 'init', 'dinkuminteractive_people_cpt_register' );

/**
 * Register Explore Area Post Type.
 */
// function dinkuminteractive_explore_area_cpt_register() {

// 	$labels = array(
// 		'name'               => _x( 'Explore Areas', 'Explore Areas', 'dinkuminteractive' ),
// 		'singular_name'      => _x( 'Explore Area', 'Explore Area', 'dinkuminteractive' ),
// 		'menu_name'          => __( 'Explore Areas', 'dinkuminteractive' ),
// 		'parent_item_colon'  => __( 'Parent Explore Area', 'dinkuminteractive' ),
// 		'all_items'          => __( 'All Explore Areas', 'dinkuminteractive' ),
// 		'view_item'          => __( 'View Explore Area', 'dinkuminteractive' ),
// 		'add_new_item'       => __( 'Add Explore Area', 'dinkuminteractive' ),
// 		'add_new'            => __( 'Add New', 'dinkuminteractive' ),
// 		'edit_item'          => __( 'Edit Explore Area', 'dinkuminteractive' ),
// 		'update_item'        => __( 'Update Explore Area', 'dinkuminteractive' ),
// 		'search_items'       => __( 'Search Explore Areas', 'dinkuminteractive' ),
// 		'not_found'          => __( 'Not Found', 'dinkuminteractive' ),
// 		'not_found_in_trash' => __( 'Not found in Trash', 'dinkuminteractive' ),
// 	);

// 	$args = array(
// 		'label'               => __( 'Explore Areas', 'dinkuminteractive' ),
// 		'description'         => __( 'Listing of Explore Areas post type.', 'dinkuminteractive' ),
// 		'labels'              => $labels,
// 		'hierarchical'        => false,
// 		'public'              => true,
// 		'show_ui'             => true,
// 		'show_in_menu'        => true,
// 		'show_in_nav_menus'   => true,
// 		'show_in_admin_bar'   => true,
// 		'menu_position'       => 32,
// 		'show_in_rest'        => true,
// 		'menu_icon'           => 'dashicons-location',
// 		'can_export'          => true,
// 		'has_archive'         => false,
// 		'rewrite'             => array(
// 			'slug'       => 'explore-area',
// 			'with_front' => false,
// 		),
// 		'exclude_from_search' => false,
// 		'publicly_queryable'  => true,
// 		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'page-attributes' ),
// 		'capability_type'     => 'page',
// 	);

// 	register_taxonomy(
// 		'explore_area_category',
// 		'explore_area',
// 		array(
// 			'hierarchical'      => true,
// 			'show_admin_column' => true,
// 			'label'             => __( 'Categorías de Areas', 'dinkuminteractive' ),
// 			'show_ui'           => true,
// 			'show_in_rest'      => true,
// 			'query_var'         => true,
// 			'rewrite'           => array( 'slug' => 'area/categoria' ),
// 			'singular_label'    => __( 'Categoría de área', 'dinkuminteractive' ),
// 		)
// 	);


// 	register_post_type( 'explore_area', $args );

// }
// add_action( 'init', 'dinkuminteractive_explore_area_cpt_register' );


add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id'            => 'primary',
			'name'          => __( 'Primary Sidebar' ),
			'description'   => __( 'A short description of the sidebar.' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	/* Repeat register_sidebar() code for additional sidebars. */
}


// fauna
// function dinkuminteractive_fauna_cpt_register() {

// 	$labels = array(
// 		'name'               => _x( 'Fauna', 'Fauna', 'dinkuminteractive' ),
// 		'singular_name'      => _x( 'Fauna', 'Fauna', 'dinkuminteractive' ),
// 		'menu_name'          => __( 'Fauna', 'dinkuminteractive' ),
// 		'parent_item_colon'  => __( 'Parent Fauna', 'dinkuminteractive' ),
// 		'all_items'          => __( 'All Fauna', 'dinkuminteractive' ),
// 		'view_item'          => __( 'View Fauna', 'dinkuminteractive' ),
// 		'add_new_item'       => __( 'Add Fauna', 'dinkuminteractive' ),
// 		'add_new'            => __( 'Add New', 'dinkuminteractive' ),
// 		'edit_item'          => __( 'Edit Fauna', 'dinkuminteractive' ),
// 		'update_item'        => __( 'Update Fauna', 'dinkuminteractive' ),
// 		'search_items'       => __( 'Search Fauna', 'dinkuminteractive' ),
// 		'not_found'          => __( 'Not Found', 'dinkuminteractive' ),
// 		'not_found_in_trash' => __( 'Not found in Trash', 'dinkuminteractive' ),
// 	);

// 	$args = array(
// 		'label'               => __( 'Fauna', 'dinkuminteractive' ),
// 		'description'         => __( 'Listing of Fauna post type.', 'dinkuminteractive' ),
// 		'labels'              => $labels,
// 		'hierarchical'        => false,
// 		'public'              => true,
// 		'show_ui'             => true,
// 		'show_in_menu'        => true,
// 		'show_in_nav_menus'   => true,
// 		'show_in_admin_bar'   => true,
// 		'menu_position'       => 32,
// 		'show_in_rest'        => true,
// 		'menu_icon'           => 'dashicons-pets',
// 		'can_export'          => true,
// 		'has_archive'         => false,
// 		'rewrite'             => array(
// 			'slug'       => 'fauna',
// 			'with_front' => false,
// 		),
// 		'exclude_from_search' => false,
// 		'publicly_queryable'  => true,
// 		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'page-attributes' ),
// 		'capability_type'     => 'page',
// 	);

// 	register_taxonomy(
// 		'fauna_category',
// 		'fauna',
// 		array(
// 			'hierarchical'      => true,
// 			'show_admin_column' => true,
// 			'label'             => __( 'Categorías de Fauna', 'dinkuminteractive' ),
// 			'show_ui'           => true,
// 			'show_in_rest'      => true,
// 			'query_var'         => true,
// 			'rewrite'           => array( 'slug' => 'fauna/categoria' ),
// 			'singular_label'    => __( 'Categoría de Fauna', 'dinkuminteractive' ),
// 		)
// 	);


// 	register_post_type( 'fauna', $args );

// }
// add_action( 'init', 'dinkuminteractive_fauna_cpt_register' );


// Flora.

// function dinkuminteractive_flora_cpt_register() {

// 	$labels = array(
// 		'name'               => _x( 'Flora', 'Flora', 'dinkuminteractive' ),
// 		'singular_name'      => _x( 'Flora', 'Flora', 'dinkuminteractive' ),
// 		'menu_name'          => __( 'Flora', 'dinkuminteractive' ),
// 		'parent_item_colon'  => __( 'Parent Flora', 'dinkuminteractive' ),
// 		'all_items'          => __( 'All Flora', 'dinkuminteractive' ),
// 		'view_item'          => __( 'View Flora', 'dinkuminteractive' ),
// 		'add_new_item'       => __( 'Add Flora', 'dinkuminteractive' ),
// 		'add_new'            => __( 'Add New', 'dinkuminteractive' ),
// 		'edit_item'          => __( 'Edit Flora', 'dinkuminteractive' ),
// 		'update_item'        => __( 'Update Flora', 'dinkuminteractive' ),
// 		'search_items'       => __( 'Search Flora', 'dinkuminteractive' ),
// 		'not_found'          => __( 'Not Found', 'dinkuminteractive' ),
// 		'not_found_in_trash' => __( 'Not found in Trash', 'dinkuminteractive' ),
// 	);

// 	$args = array(
// 		'label'               => __( 'Flora', 'dinkuminteractive' ),
// 		'description'         => __( 'Listing of Flora post type.', 'dinkuminteractive' ),
// 		'labels'              => $labels,
// 		'hierarchical'        => false,
// 		'public'              => true,
// 		'show_ui'             => true,
// 		'show_in_menu'        => true,
// 		'show_in_nav_menus'   => true,
// 		'show_in_admin_bar'   => true,
// 		'menu_position'       => 32,
// 		'show_in_rest'        => true,
// 		'menu_icon'           => 'dashicons-palmtree',
// 		'can_export'          => true,
// 		'has_archive'         => false,
// 		'rewrite'             => array(
// 			'slug'       => 'flora',
// 			'with_front' => false,
// 		),
// 		'exclude_from_search' => false,
// 		'publicly_queryable'  => true,
// 		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'page-attributes' ),
// 		'capability_type'     => 'page',
// 	);

// 	register_taxonomy(
// 		'flora_category',
// 		'flora',
// 		array(
// 			'hierarchical'      => true,
// 			'show_admin_column' => true,
// 			'label'             => __( 'Categorías de Flora', 'dinkuminteractive' ),
// 			'show_ui'           => true,
// 			'show_in_rest'      => true,
// 			'query_var'         => true,
// 			'rewrite'           => array( 'slug' => 'flora/categoria' ),
// 			'singular_label'    => __( 'Categoría de Flora', 'dinkuminteractive' ),
// 		)
// 	);


// 	register_post_type( 'flora', $args );

// }
// add_action( 'init', 'dinkuminteractive_flora_cpt_register' );

function es_mes_de_avistaje( $meses, $mes ) {
	if ( !is_array( $meses ) ) {
		return false;
	}
	return in_array( $mes, $meses );
}
