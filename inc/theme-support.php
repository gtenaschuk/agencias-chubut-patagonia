<?php
/**
 * Theme Support.
 *
 * @package WordPress
 * @subpackage Dinkum_Gutenberg_V2
 * @since 1.0.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0.0
 * @return void
 */

function dinkuminteractive_theme_support() {
	$edition_version_string = '1.0.9';

	// Enqueue editor styles.
	$editor_stylesheet_path = array(
		get_template_directory_uri() . '/dist/css/style.min.css',
		'/dist/css/editor-style.css',
	);

	wp_enqueue_script(
		'dinkuminteractive-extended-block',
		get_template_directory_uri() . '/dist/js/lib/extended-block.js',
		array( 'wp-blocks' ),
		$edition_version_string,
		true
	);

	wp_enqueue_script(
		'dinkuminteractive-imageloaded',
		get_template_directory_uri() . '/dist/js/lib/imagesloaded.pkgd.min.js',
		array( 'jquery' ),
		$edition_version_string,
		false
	);

	wp_enqueue_script(
		'dinkuminteractive-isotope',
		get_template_directory_uri() . '/dist/js/lib/isotope.pkgd.min.js',
		array( 'jquery' ),
		$edition_version_string,
		false
	);

	wp_enqueue_script(
		'dinkuminteractive-magnific-popup',
		get_template_directory_uri() . '/dist/js/lib/jquery.magnific-popup.min.js',
		array( 'jquery' ),
		$edition_version_string,
		false
	);

	wp_enqueue_style(
		'dinkuminteractive-magnific-popup',
		get_template_directory_uri() . '/dist/css/lib/magnific-popup.css',
		array(  ),
		$edition_version_string
	);

	wp_enqueue_script(
		'dinkuminteractive-main',
		get_template_directory_uri() . '/dist/js/main.js',
		array( 'jquery' ),
		$edition_version_string,
		true
	);



	function pv_enqueue_scritps() {
		if ( is_page( array( 'agencias/hojas-de-ruta-registro', 'construyamos-juntos/sugerencias-y-comentarios', 'construyamos-juntos/aportando-material-de-difusion' ) ) ) { // Optional: load only on a specific page.
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
		}
		wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/2787449744.js', array(), '1.0.0', false );
	}
	add_action('wp_enqueue_scripts', 'pv_enqueue_scritps');


	add_editor_style( $editor_stylesheet_path );

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom line height controls.
	add_theme_support( 'custom-line-height' );

	// Add post thumbnail feature.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1568, 9999 );

	// Enables post and comment RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add post-formats support.
	add_theme_support(
		'post-formats',
		array(
			'link',
			'aside',
			'gallery',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	// Add support for core custom logo.
	$logo_width  = get_option( 'thumbnail_size_w', 300 );
	$logo_height = get_option( 'thumbnail_size_h', 100 );
	add_theme_support(
		'custom-logo',
		array(
			'width'                => $logo_width,
			'height'               => $logo_height,
			'flex-width'           => true,
			'flex-height'          => true,
			'unlink-homepage-logo' => true,
		)
	);

	// Let WordPress manage the document title.
	remove_action( 'wp_head', '_wp_render_title_tag', 1 );    // Remove conditional title tag rendering...
	add_action( 'wp_head', '_block_template_render_title_tag', 1 ); // ...and make it unconditional.

	// Make theme available for translation.
	load_theme_textdomain( 'dinkuminteractive', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'dinkuminteractive_theme_support' );

/**
 * Allowing svg images
 *
 * @since 1.0.0
 * @param string $file_types file types.
 * @return string file types + new file type.
 */
function base_theme_file_types_to_uploads( $file_types ) {
	$new_filetypes        = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types           = array_merge( $file_types, $new_filetypes );
	return $file_types;
}
add_filter( 'upload_mimes', 'base_theme_file_types_to_uploads' );
