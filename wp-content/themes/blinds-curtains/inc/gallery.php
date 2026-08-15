<?php
/**
 * Gallery content (Figma node 2:2691).
 *
 * Tiles are stored as options rather than posts — they are a fixed marketing
 * grid, not editorial content. `bc_gallery_image_url()` prefers an imported
 * media item and falls back to a theme asset so the page always renders.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter buttons above the grid.
 *
 * @return array<string, string>
 */
function bc_gallery_filters() {
	return apply_filters( 'bc_gallery_filters', array(
		'all'       => __( 'All', 'blinds-curtains' ),
		'blinds'    => __( 'Blinds', 'blinds-curtains' ),
		'curtains'  => __( 'Curtains', 'blinds-curtains' ),
		// Shutters dropped — not a product we supply.
		'motorised' => __( 'Motorised', 'blinds-curtains' ),
	) );
}

/**
 * The twelve gallery tiles, in canvas order.
 *
 * `search` drives the Pexels import; `fallback` is a bundled theme asset.
 *
 * @return array<int, array{key:string,label:string,cat:string,search:string,fallback:string}>
 */
function bc_gallery_items() {
	return apply_filters( 'bc_gallery_items', array(
		array( 'key' => 'hotel-curtains',        'label' => __( 'Hotel Curtains', 'blinds-curtains' ),        'cat' => 'curtains',  'search' => 'hotel room curtains luxury',        'fallback' => 'gal-tile-01.jpg' ),
		array( 'key' => 'honeycomb-blinds',      'label' => __( 'Honeycomb Blinds', 'blinds-curtains' ),      'cat' => 'blinds',    'search' => 'honeycomb cellular blinds window',  'fallback' => 'gal-tile-02.jpg' ),
		array( 'key' => 'gym',                   'label' => __( 'Gym', 'blinds-curtains' ),                   'cat' => 'blinds',    'search' => 'gym interior large windows blinds', 'fallback' => 'gal-tile-03.jpg' ),
		array( 'key' => 'dimout-blinds',         'label' => __( 'Dimout Blinds', 'blinds-curtains' ),         'cat' => 'blinds',    'search' => 'dimout vertical blinds pattern',    'fallback' => 'gal-tile-04.jpg' ),
		array( 'key' => 'transparent-blinds',    'label' => __( 'Transparent Blinds', 'blinds-curtains' ),    'cat' => 'blinds',    'search' => 'sheer transparent blinds window',   'fallback' => 'gal-tile-05.jpg' ),
		// The three shutter tiles were replaced with products we actually
		// supply, so the grid stays a full 4x3.
		array( 'key' => 'roller-blinds',         'label' => __( 'Roller Blinds', 'blinds-curtains' ),         'cat' => 'blinds',    'search' => 'roller blind window interior',      'fallback' => 'rectangle6.jpg' ),
		array( 'key' => 'motorised-curtains',    'label' => __( 'Motorised Curtains', 'blinds-curtains' ),    'cat' => 'motorised', 'search' => 'motorized curtains smart home',     'fallback' => 'gal-smart.jpg' ),
		array( 'key' => 'living-room-curtains',  'label' => __( 'Living Room Curtains', 'blinds-curtains' ),  'cat' => 'curtains',  'search' => 'living room curtains interior',     'fallback' => 'rectangle5.jpg' ),
		array( 'key' => 'blackout-roller',       'label' => __( 'Blackout Roller Blinds', 'blinds-curtains' ), 'cat' => 'blinds',   'search' => 'blackout roller blind white',       'fallback' => 'gal-tile-09.jpg' ),
		array( 'key' => 'theatre',               'label' => __( 'Theatre', 'blinds-curtains' ),               'cat' => 'curtains',  'search' => 'theatre red stage curtains',        'fallback' => 'gal-tile-10.jpg' ),
		array( 'key' => 'day-night-blinds',      'label' => __( 'Day/Night Blinds', 'blinds-curtains' ),      'cat' => 'motorised', 'search' => 'day night blinds city view window', 'fallback' => 'gal-tile-11.jpg' ),
		array( 'key' => 'hotel-restaurants',     'label' => __( 'Hotel & Restaurants', 'blinds-curtains' ),   'cat' => 'curtains',  'search' => 'restaurant interior curtains',      'fallback' => 'gal-tile-12.jpg' ),
	) );
}

/**
 * Resolve a tile's image: imported attachment first, bundled asset otherwise.
 *
 * @param array $item One entry from bc_gallery_items().
 * @return string
 */
function bc_gallery_image_url( $item ) {
	$map = get_option( 'bc_gallery_images', array() );

	if ( ! empty( $map[ $item['key'] ] ) ) {
		$url = wp_get_attachment_image_url( (int) $map[ $item['key'] ], 'bc-tile' );
		if ( $url ) {
			return $url;
		}
	}

	return BC_URI . '/assets/img/' . $item['fallback'];
}
