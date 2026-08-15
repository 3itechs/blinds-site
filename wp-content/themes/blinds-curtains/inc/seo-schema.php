<?php
/**
 * JSON-LD structured data.
 *
 * Emitted as a single @graph so entities can cross-reference by @id, which is
 * how Google and AI answer engines prefer to consume it.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Stable @id anchors.
 *
 * @param string $suffix Fragment name.
 * @return string
 */
function bc_schema_id( $suffix ) {
	return home_url( '/#' . $suffix );
}

/**
 * The Organization / LocalBusiness node.
 *
 * @return array<string, mixed>
 */
function bc_schema_organization() {
	$s = bc_seo_settings();

	$node = array(
		'@type' => array( 'Organization', $s['org_type'] ),
		'@id'   => bc_schema_id( 'organization' ),
		'name'  => $s['org_name'] ? $s['org_name'] : get_bloginfo( 'name' ),
		'url'   => home_url( '/' ),
	);

	if ( $s['org_legal_name'] ) {
		$node['legalName'] = $s['org_legal_name'];
	}

	$logo_id = (int) $s['logo_id'];
	if ( $logo_id ) {
		$src = wp_get_attachment_image_src( $logo_id, 'full' );
		if ( $src ) {
			$node['logo'] = array(
				'@type'  => 'ImageObject',
				'@id'    => bc_schema_id( 'logo' ),
				'url'    => $src[0],
				'width'  => (int) $src[1],
				'height' => (int) $src[2],
			);
			$node['image'] = array( '@id' => bc_schema_id( 'logo' ) );
		}
	}

	if ( $s['phone'] ) {
		$node['telephone'] = $s['phone'];
	}
	if ( $s['email'] ) {
		$node['email'] = $s['email'];
	}
	if ( $s['price_range'] ) {
		$node['priceRange'] = $s['price_range'];
	}

	$address = array_filter( array(
		'streetAddress'   => $s['street'],
		'addressLocality' => $s['locality'],
		'addressRegion'   => $s['region'],
		'postalCode'      => $s['postal_code'],
		'addressCountry'  => $s['country'],
	) );

	if ( $address ) {
		$node['address'] = array_merge( array( '@type' => 'PostalAddress' ), $address );
	}

	if ( $s['latitude'] && $s['longitude'] ) {
		$node['geo'] = array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => (float) $s['latitude'],
			'longitude' => (float) $s['longitude'],
		);
	}

	if ( $s['opening_hours'] ) {
		$node['openingHours'] = $s['opening_hours'];
	}

	$profiles = array_filter( array_map( 'trim', preg_split( '/[\r\n,]+/', (string) $s['social_profiles'] ) ) );
	if ( $profiles ) {
		$node['sameAs'] = array_values( $profiles );
	}

	return $node;
}

/**
 * WebSite node, including the search action.
 *
 * @return array<string, mixed>
 */
function bc_schema_website() {
	return array(
		'@type'           => 'WebSite',
		'@id'             => bc_schema_id( 'website' ),
		'url'             => home_url( '/' ),
		'name'            => get_bloginfo( 'name' ),
		'description'     => get_bloginfo( 'description' ),
		'publisher'       => array( '@id' => bc_schema_id( 'organization' ) ),
		'inLanguage'      => get_bloginfo( 'language' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);
}

/**
 * Breadcrumb trail as data only — no visible markup is added to the page.
 *
 * @return array<string, mixed>|null
 */
function bc_schema_breadcrumbs() {
	if ( is_front_page() ) {
		return null;
	}

	$items = array();
	$pos   = 1;

	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $pos++,
		'name'     => __( 'Home', 'blinds-curtains' ),
		'item'     => home_url( '/' ),
	);

	if ( is_singular( 'bc_product' ) ) {
		$terms = get_the_terms( get_the_ID(), 'bc_product_cat' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$term    = $terms[0];
			$link    = get_term_link( $term );
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $pos++,
				'name'     => $term->name,
				'item'     => is_wp_error( $link ) ? home_url( '/' ) : $link,
			);
		}
	}

	if ( is_singular() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $pos,
			'name'     => get_the_title(),
			'item'     => get_permalink(),
		);
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$link    = get_term_link( $term );
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $pos,
				'name'     => $term->name,
				'item'     => is_wp_error( $link ) ? home_url( '/' ) : $link,
			);
		}
	} else {
		return null;
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'@id'             => bc_schema_id( 'breadcrumb' ),
		'itemListElement' => $items,
	);
}

/**
 * Product node for a single product, with an Offer carrying the price.
 *
 * @return array<string, mixed>|null
 */
function bc_schema_product() {
	if ( ! is_singular( 'bc_product' ) ) {
		return null;
	}

	$id       = get_the_ID();
	$price    = get_post_meta( $id, 'bc_price', true );
	$currency = get_post_meta( $id, 'bc_currency', true );
	$currency = $currency ? $currency : 'AED';

	$node = array(
		'@type'       => 'Product',
		'@id'         => get_permalink() . '#product',
		'name'        => get_the_title(),
		'description' => bc_seo_resolve_description(),
		'url'         => get_permalink(),
		'brand'       => array( '@id' => bc_schema_id( 'organization' ) ),
	);

	$gallery = function_exists( 'bc_product_gallery' ) ? bc_product_gallery( $id ) : array();
	if ( $gallery ) {
		$node['image'] = wp_list_pluck( $gallery, 'full' );
	}

	$terms = get_the_terms( $id, 'bc_product_cat' );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$node['category'] = $terms[0]->name;
	}

	$features = get_post_meta( $id, 'bc_features', true );
	if ( $features ) {
		$props = array();
		foreach ( array_filter( array_map( 'trim', explode( ',', $features ) ) ) as $feature ) {
			$props[] = array(
				'@type' => 'PropertyValue',
				'name'  => $feature,
				'value' => 'true',
			);
		}
		if ( $props ) {
			$node['additionalProperty'] = $props;
		}
	}

	if ( $price ) {
		$node['offers'] = array(
			'@type'         => 'Offer',
			'url'           => get_permalink(),
			'price'         => preg_replace( '/[^0-9.]/', '', $price ),
			'priceCurrency' => $currency,
			'availability'  => 'https://schema.org/InStock',
			'seller'        => array( '@id' => bc_schema_id( 'organization' ) ),
			// Made-to-measure: the listed figure is a starting price.
			'priceValidUntil' => gmdate( 'Y-12-31' ),
		);
	}

	return $node;
}

/**
 * FAQPage node built from the same source the accordion renders, so the
 * markup and the structured data cannot drift apart.
 *
 * @return array<string, mixed>|null
 */
function bc_schema_faq() {
	if ( ! function_exists( 'bc_faqs' ) ) {
		return null;
	}

	// Only the templates that actually render the accordion.
	$shows_faq = is_page_template( 'page-faqs.php' )
		|| is_page_template( 'page-motorised.php' )
		|| is_singular( 'bc_product' );

	if ( ! $shows_faq ) {
		return null;
	}

	$entities = array();
	foreach ( bc_faqs() as $faq ) {
		$entities[] = array(
			'@type'          => 'Question',
			'name'           => $faq['q'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $faq['a'],
			),
		);
	}

	if ( ! $entities ) {
		return null;
	}

	return array(
		'@type'      => 'FAQPage',
		'@id'        => bc_seo_resolve_canonical() . '#faq',
		'mainEntity' => $entities,
	);
}

/**
 * ItemList for product archives, so listings can surface as a carousel.
 *
 * @return array<string, mixed>|null
 */
function bc_schema_item_list() {
	if ( ! ( is_post_type_archive( 'bc_product' ) || is_tax( 'bc_product_cat' ) ) ) {
		return null;
	}

	global $wp_query;
	if ( empty( $wp_query->posts ) ) {
		return null;
	}

	$items = array();
	foreach ( $wp_query->posts as $i => $post ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $i + 1,
			'url'      => get_permalink( $post ),
			'name'     => get_the_title( $post ),
		);
	}

	return array(
		'@type'           => 'ItemList',
		'@id'             => bc_seo_resolve_canonical() . '#list',
		'numberOfItems'   => count( $items ),
		'itemListElement' => $items,
	);
}

/**
 * WebPage node tying the current URL to the site and organisation.
 *
 * @return array<string, mixed>
 */
function bc_schema_webpage() {
	$canonical = bc_seo_resolve_canonical();

	$node = array(
		'@type'      => 'WebPage',
		'@id'        => ( $canonical ? $canonical : home_url( '/' ) ) . '#webpage',
		'url'        => $canonical ? $canonical : home_url( '/' ),
		'name'       => bc_seo_resolve_title(),
		'isPartOf'   => array( '@id' => bc_schema_id( 'website' ) ),
		'about'      => array( '@id' => bc_schema_id( 'organization' ) ),
		'inLanguage' => get_bloginfo( 'language' ),
	);

	$desc = bc_seo_resolve_description();
	if ( $desc ) {
		$node['description'] = $desc;
	}

	if ( is_singular() ) {
		$node['datePublished'] = get_the_date( DATE_W3C );
		$node['dateModified']  = get_the_modified_date( DATE_W3C );
	}

	$image = bc_seo_resolve_image();
	if ( $image ) {
		$node['primaryImageOfPage'] = array(
			'@type' => 'ImageObject',
			'url'   => $image['url'],
			'width' => $image['width'],
			'height' => $image['height'],
		);
	}

	return $node;
}

/**
 * Print the combined @graph.
 */
function bc_schema_output() {
	if ( ! bc_seo_option( 'enable_schema', 1 ) ) {
		return;
	}

	$graph = array_values( array_filter( array(
		bc_schema_organization(),
		bc_schema_website(),
		bc_schema_webpage(),
		bc_schema_breadcrumbs(),
		bc_schema_product(),
		bc_schema_faq(),
		bc_schema_item_list(),
	) ) );

	if ( ! $graph ) {
		return;
	}

	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	);
}
add_action( 'wp_head', 'bc_schema_output', 5 );
