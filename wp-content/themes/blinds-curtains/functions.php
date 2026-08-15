<?php
/**
 * Theme setup and asset loading.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BC_VERSION', '0.1.0' );
define( 'BC_DIR', get_template_directory() );
define( 'BC_URI', get_template_directory_uri() );

require_once BC_DIR . '/inc/template-tags.php';
require_once BC_DIR . '/inc/home-content.php';
require_once BC_DIR . '/inc/appointment.php';
require_once BC_DIR . '/inc/products.php';
require_once BC_DIR . '/inc/gallery.php';
require_once BC_DIR . '/inc/seo.php';

/**
 * Theme supports, menus and image sizes.
 */
function bc_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo', array(
		'height'      => 64,
		'width'       => 180,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'blinds-curtains' ),
		'topbar'  => __( 'Top Bar', 'blinds-curtains' ),
		'footer'  => __( 'Footer', 'blinds-curtains' ),
	) );

	// Card and gallery crops used across the design.
	add_image_size( 'bc-card', 400, 300, true );
	add_image_size( 'bc-tile', 600, 600, true );
	add_image_size( 'bc-hero', 1920, 900, true );
}
add_action( 'after_setup_theme', 'bc_setup' );

/**
 * Enqueue styles and scripts.
 *
 * Each stylesheet is registered separately so per-template CSS can be loaded
 * only where it is needed.
 */
function bc_assets() {
	// Montserrat (body), Plus Jakarta Sans (UI labels), Poltawski Nowy (wordmark).
	// Served from Google Fonts; self-host these before launch if GDPR matters.
	wp_enqueue_style(
		'bc-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600&family=Poltawski+Nowy:wght@500;600&display=swap',
		array(),
		null
	);

	$css = array( 'tokens', 'base', 'layout', 'components' );

	$deps = array();
	foreach ( $css as $handle ) {
		$path = "/assets/css/{$handle}.css";
		wp_enqueue_style(
			"bc-{$handle}",
			BC_URI . $path,
			$deps,
			bc_asset_version( $path )
		);
		$deps = array( "bc-{$handle}" );
	}

	wp_enqueue_script(
		'bc-main',
		BC_URI . '/assets/js/main.js',
		array(),
		bc_asset_version( '/assets/js/main.js' ),
		true
	);

	/*
	 * Section styles live in per-template files but the sections themselves are
	 * shared, so load whichever combination a request actually needs.
	 * home.css carries the testimonial, inspiration, need-help, steps and
	 * appointment-form rules that most templates reuse.
	 */
	bc_page_style( 'home' );

	if ( is_post_type_archive( 'bc_product' ) || is_tax( 'bc_product_cat' ) || is_singular( 'bc_product' ) || is_page() ) {
		bc_page_style( 'category' );
		bc_page_style( 'pages' );
	}

	if ( is_singular( 'bc_product' ) ) {
		bc_page_style( 'product' );
	}

	if ( is_page_template( 'page-gallery.php' ) ) {
		bc_page_style( 'gallery-extra' );
	}

	if ( is_page_template( 'page-free-in-home-consultation.php' ) ) {
		bc_page_style( 'consultation' );
	}
}
add_action( 'wp_enqueue_scripts', 'bc_assets' );

/**
 * Cache-bust on file modification time so local edits show up immediately.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
/**
 * Warm up the Google Fonts connection so the stylesheet and the font files it
 * pulls from a second origin do not each pay a fresh TLS handshake.
 */
function bc_resource_hints( $hints, $relation ) {
	if ( 'preconnect' === $relation ) {
		$hints[] = array( 'href' => 'https://fonts.googleapis.com' );
		$hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'bc_resource_hints', 10, 2 );

/**
 * Trim WordPress default head output that this theme does not use.
 */
function bc_tidy_head() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	// Emoji detection ships ~15KB of JS that this site never needs.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'bc_tidy_head' );

/**
 * Drop the block editor's front-end stylesheet — no block content is rendered.
 */
function bc_dequeue_block_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'bc_dequeue_block_styles', 100 );

function bc_asset_version( $relative_path ) {
	$file = BC_DIR . $relative_path;
	return file_exists( $file ) ? (string) filemtime( $file ) : BC_VERSION;
}

/**
 * Load a per-template stylesheet, e.g. bc_page_style( 'home' ).
 *
 * @param string $name Basename inside assets/css/pages/.
 */
function bc_page_style( $name ) {
	$path = "/assets/css/pages/{$name}.css";
	if ( file_exists( BC_DIR . $path ) ) {
		wp_enqueue_style( "bc-page-{$name}", BC_URI . $path, array( 'bc-components' ), bc_asset_version( $path ) );
	}
}
