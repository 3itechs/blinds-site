<?php
/**
 * Product post type, taxonomy and the type catalogue.
 *
 * The Figma file has one Blinds Category design (2:528) and one Product Detail
 * design (2:3012). Rather than duplicating those into 15 hand-built pages, a
 * single post type drives both templates so adding a type later is a content
 * change, not a code change.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the product type and its Blinds/Curtains taxonomy.
 */
function bc_register_products() {
	register_post_type( 'bc_product', array(
		'labels'       => array(
			'name'          => __( 'Products', 'blinds-curtains' ),
			'singular_name' => __( 'Product', 'blinds-curtains' ),
			'add_new_item'  => __( 'Add New Product', 'blinds-curtains' ),
			'edit_item'     => __( 'Edit Product', 'blinds-curtains' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-store',
		'rewrite'      => array( 'slug' => 'products', 'with_front' => false ),
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'show_in_rest' => true,
	) );

	register_taxonomy( 'bc_product_cat', 'bc_product', array(
		'labels'            => array(
			'name'          => __( 'Product Categories', 'blinds-curtains' ),
			'singular_name' => __( 'Product Category', 'blinds-curtains' ),
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'range', 'with_front' => false ),
	) );
}
add_action( 'init', 'bc_register_products' );

/**
 * The catalogue supplied by the client.
 *
 * `search` is the Pexels query used to source a hero image at import time.
 * Note: the client's curtain list contained "Pinch Pleat" twice, so seven
 * unique curtain types are defined here rather than eight.
 *
 * @return array<string, array<int, array{name:string, search:string}>>
 */
function bc_product_catalogue() {
	return apply_filters( 'bc_product_catalogue', array(
		'blinds' => array(
			array( 'name' => 'Roller Blinds',    'search' => 'roller blind window interior' ),
			array( 'name' => 'Roman Blinds',     'search' => 'roman blind window fabric' ),
			array( 'name' => 'Motorised Blinds', 'search' => 'motorized blinds smart home window' ),
			array( 'name' => 'Blackout Blinds',  'search' => 'blackout blind dark bedroom window' ),
			array( 'name' => 'Vertical Blinds',  'search' => 'vertical blinds office window' ),
			array( 'name' => 'Zebra Blinds',     'search' => 'zebra blinds striped window shade' ),
			array( 'name' => 'Aluminium Blinds', 'search' => 'aluminium venetian blinds window' ),
			array( 'name' => 'Sky Blinds',       'search' => 'skylight blind roof window' ),
		),
		'curtains' => array(
			array( 'name' => 'Blackout Curtains',    'search' => 'blackout curtains bedroom' ),
			array( 'name' => 'Sheer Curtains',       'search' => 'sheer curtains living room light' ),
			array( 'name' => 'Motorised Curtains',   'search' => 'motorized curtains smart home' ),
			array( 'name' => 'Linen Curtains',       'search' => 'linen curtains natural interior' ),
			array( 'name' => 'Wave Fold Curtains',   'search' => 'wave fold curtains modern interior' ),
			array( 'name' => 'Pinch Pleat Curtains', 'search' => 'pinch pleat curtains elegant' ),
			array( 'name' => 'Eyelet Curtains',      'search' => 'eyelet curtains grommet window' ),
		),
	) );
}

/**
 * Feature list shown in the cream card on the category pages
 * (Figma nodes 2:856 – 2:871).
 *
 * @return array<int, array{title:string,text:string}>
 */
function bc_category_features() {
	return apply_filters( 'bc_category_features', array(
		array(
			'title' => __( 'We Take Care Of It All', 'blinds-curtains' ),
			'text'  => __( 'Measuring and Fitting is always Included', 'blinds-curtains' ),
		),
		array(
			'title' => __( 'Style for All Budgets', 'blinds-curtains' ),
			'text'  => __( 'Flexible payment options make it easy', 'blinds-curtains' ),
		),
		array(
			'title' => __( 'Expert Advice In The Comfort of Home', 'blinds-curtains' ),
			'text'  => __( 'Your Local Advisor will hlep you get it right', 'blinds-curtains' ),
		),
		array(
			'title' => __( "Everything's Fully Guaranteed", 'blinds-curtains' ),
			'text'  => __( 'You Can Be Sure Your Blinds and made to last', 'blinds-curtains' ),
		),
	) );
}

/**
 * The three numbered steps in the "How our service Work" bar (node 2:669).
 *
 * @return array<int, string>
 */
function bc_service_steps() {
	return apply_filters( 'bc_service_steps', array(
		__( 'Browse our range, free samples available', 'blinds-curtains' ),
		__( 'Book an appointment with your local advisor', 'blinds-curtains' ),
		__( 'Book an appointment with your local advisor', 'blinds-curtains' ),
	) );
}

/**
 * FAQ entries (Figma node 2:3012). Shared by product pages and the FAQs page.
 *
 * @return array<int, array{q:string,a:string}>
 */
function bc_faqs() {
	return apply_filters( 'bc_faqs', array(
		array(
			'q' => __( 'What are the advantages of blinds and curtains in Dubai?', 'blinds-curtains' ),
			'a' => __( 'Dubai’s climate is the main reason. The right fabric keeps direct sun off your furniture, holds heat out of the room so the AC works less, and gives you privacy without shutting out daylight. Made-to-measure also means a clean fit with no gaps at the edges, which is where most of the heat and glare gets in.', 'blinds-curtains' ),
		),
		array(
			'q' => __( 'Are blinds and curtains easy to clean and maintain?', 'blinds-curtains' ),
			'a' => __( 'Blinds need little more than a regular dusting, and a wipe with a damp cloth for kitchen or bathroom fittings. Most of our curtain fabrics can be professionally cleaned, and we will tell you which ones at the consultation so there are no surprises later.', 'blinds-curtains' ),
		),
		array(
			'q' => __( 'Are your blinds child- and pet-friendly?', 'blinds-curtains' ),
			'a' => __( 'Yes. Every blind is supplied with a child-safety device as standard, and we can fit cordless or motorised operation to remove loose cords entirely — the safest option in homes with young children or pets.', 'blinds-curtains' ),
		),
		array(
			'q' => __( 'Do I need a consultation before ordering?', 'blinds-curtains' ),
			'a' => __( 'We recommend it, and it is free. Fabric behaves differently depending on how much light a window gets and which way it faces, so seeing samples in your own room is the only reliable way to choose. Your advisor also measures on site, which is what the fit depends on.', 'blinds-curtains' ),
		),
		array(
			'q' => __( 'How long do blinds and curtains last in Dubai?', 'blinds-curtains' ),
			'a' => __( 'With normal use you should expect many years of service. We give a 10-year warranty on hardware and mechanisms and 5 years on fabrics, so if something fails within that period we repair or replace it.', 'blinds-curtains' ),
		),
	) );
}

/**
 * Gallery images for a product: the featured image first, then any attached
 * images, capped at the five thumbnails the design shows.
 *
 * @param int $post_id Product ID.
 * @return array<int, array{full:string,thumb:string}>
 */
function bc_product_gallery( $post_id ) {
	$ids = array();

	if ( has_post_thumbnail( $post_id ) ) {
		$ids[] = get_post_thumbnail_id( $post_id );
	}

	$attached = get_posts( array(
		'post_parent'    => $post_id,
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'posts_per_page' => 8,
		'orderby'        => 'menu_order ID',
		'order'          => 'ASC',
		'fields'         => 'ids',
	) );

	$ids = array_slice( array_unique( array_merge( $ids, $attached ) ), 0, 5 );

	$out = array();
	foreach ( $ids as $id ) {
		$full  = wp_get_attachment_image_url( $id, 'large' );
		$thumb = wp_get_attachment_image_url( $id, 'bc-card' );
		if ( $full ) {
			$out[] = array( 'full' => $full, 'thumb' => $thumb ? $thumb : $full );
		}
	}

	return $out;
}

/**
 * Meta box for the commercial fields shown on the product page.
 */
function bc_product_meta_box() {
	add_meta_box(
		'bc_product_details',
		__( 'Product Details', 'blinds-curtains' ),
		'bc_render_product_meta_box',
		'bc_product',
		'side'
	);
}
add_action( 'add_meta_boxes', 'bc_product_meta_box' );

/**
 * Render the product meta box.
 *
 * @param WP_Post $post Current post.
 */
function bc_render_product_meta_box( $post ) {
	wp_nonce_field( 'bc_product_meta', 'bc_product_meta_nonce' );

	$fields = array(
		'bc_currency' => array( __( 'Currency', 'blinds-curtains' ), 'AED' ),
		'bc_price'    => array( __( 'Starting price', 'blinds-curtains' ), '530' ),
		'bc_size'     => array( __( 'Size', 'blinds-curtains' ), '3m X 1.5m' ),
		'bc_features' => array( __( 'Feature chips (comma separated)', 'blinds-curtains' ), 'Light Blockage, Privacy, Energy-Efficient, Huge Choices' ),
	);

	foreach ( $fields as $key => $meta ) {
		$value = get_post_meta( $post->ID, $key, true );
		printf(
			'<p><label for="%1$s"><strong>%2$s</strong></label><input type="text" id="%1$s" name="%1$s" value="%3$s" placeholder="%4$s" style="width:100%%"></p>',
			esc_attr( $key ),
			esc_html( $meta[0] ),
			esc_attr( $value ),
			esc_attr( $meta[1] )
		);
	}
}

/**
 * Persist the product meta box.
 *
 * @param int $post_id Post being saved.
 */
function bc_save_product_meta( $post_id ) {
	if ( ! isset( $_POST['bc_product_meta_nonce'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['bc_product_meta_nonce'] ) ), 'bc_product_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( array( 'bc_currency', 'bc_price', 'bc_size', 'bc_features' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post_bc_product', 'bc_save_product_meta' );

/**
 * Products per page on the archive — the design shows a 4x2 grid.
 *
 * @param WP_Query $query Main query.
 */
function bc_products_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_post_type_archive( 'bc_product' ) || $query->is_tax( 'bc_product_cat' ) ) {
		$query->set( 'posts_per_page', 8 );
		$query->set( 'orderby', 'menu_order title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'bc_products_per_page' );
