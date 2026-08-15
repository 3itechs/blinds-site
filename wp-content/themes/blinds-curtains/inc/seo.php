<?php
/**
 * SEO core: option storage, per-object overrides and value resolution.
 *
 * Everything this module produces is <head> output or admin UI. It never
 * alters page content or layout.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const BC_SEO_OPTION = 'bc_seo_settings';

require_once BC_DIR . '/inc/seo-admin.php';
require_once BC_DIR . '/inc/seo-head.php';
require_once BC_DIR . '/inc/seo-schema.php';

/**
 * Site-wide SEO settings with defaults applied.
 *
 * @return array<string, mixed>
 */
function bc_seo_settings() {
	$defaults = array(
		'org_name'         => get_bloginfo( 'name' ),
		'org_legal_name'   => '',
		'org_type'         => 'HomeAndConstructionBusiness',
		'logo_id'          => 0,
		'default_og_id'    => 0,
		'phone'            => '',
		'email'            => '',
		'street'           => '',
		'locality'         => 'Dubai',
		'region'           => 'Dubai',
		'postal_code'      => '',
		'country'          => 'AE',
		'latitude'         => '',
		'longitude'        => '',
		'price_range'      => 'AED',
		'opening_hours'    => 'Mo-Su 09:00-19:00',
		'twitter_handle'   => '',
		'social_profiles'  => '',
		'google_verify'    => '',
		'bing_verify'      => '',
		'title_separator'  => '|',
		'home_title'       => '',
		'home_description' => '',
		'enable_schema'    => 1,
		'enable_og'        => 1,
		'enable_llms'      => 1,
		'allow_ai_bots'    => 1,
	);

	$saved = get_option( BC_SEO_OPTION, array() );

	return wp_parse_args( is_array( $saved ) ? $saved : array(), $defaults );
}

/**
 * Read one site-wide setting.
 *
 * @param string $key     Setting key.
 * @param mixed  $default Value when unset.
 * @return mixed
 */
function bc_seo_option( $key, $default = '' ) {
	$settings = bc_seo_settings();
	return isset( $settings[ $key ] ) && '' !== $settings[ $key ] ? $settings[ $key ] : $default;
}

/**
 * The per-object override fields, used by both the meta box and the resolver.
 *
 * @return array<string, string>
 */
function bc_seo_fields() {
	return array(
		'bc_seo_title'       => __( 'SEO title', 'blinds-curtains' ),
		'bc_seo_description' => __( 'Meta description', 'blinds-curtains' ),
		'bc_seo_keywords'    => __( 'Focus keywords', 'blinds-curtains' ),
		'bc_seo_canonical'   => __( 'Canonical URL', 'blinds-curtains' ),
		'bc_seo_og_title'    => __( 'Social title', 'blinds-curtains' ),
		'bc_seo_og_desc'     => __( 'Social description', 'blinds-curtains' ),
		'bc_seo_og_image'    => __( 'Social image ID', 'blinds-curtains' ),
		'bc_seo_noindex'     => __( 'Hide from search engines', 'blinds-curtains' ),
		'bc_seo_nofollow'    => __( 'Do not follow links', 'blinds-curtains' ),
	);
}

/**
 * Post types that get the SEO meta box.
 *
 * @return array<int, string>
 */
function bc_seo_post_types() {
	return apply_filters( 'bc_seo_post_types', array( 'page', 'post', 'bc_product' ) );
}

/**
 * The resolved title for the current request, before the site-name suffix.
 *
 * @return string
 */
function bc_seo_resolve_title() {
	if ( is_front_page() ) {
		$custom = bc_seo_option( 'home_title' );
		if ( $custom ) {
			return $custom;
		}
		return get_bloginfo( 'name' );
	}

	if ( is_singular() ) {
		$custom = get_post_meta( get_the_ID(), 'bc_seo_title', true );
		if ( $custom ) {
			return $custom;
		}
		return get_the_title();
	}

	if ( is_tax() || is_category() || is_tag() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$custom = get_term_meta( $term->term_id, 'bc_seo_title', true );
			if ( $custom ) {
				return $custom;
			}
			return $term->name;
		}
	}

	if ( is_post_type_archive() ) {
		return post_type_archive_title( '', false );
	}

	if ( is_search() ) {
		/* translators: %s: search term */
		return sprintf( __( 'Search results for %s', 'blinds-curtains' ), get_search_query() );
	}

	if ( is_404() ) {
		return __( 'Page not found', 'blinds-curtains' );
	}

	return get_bloginfo( 'name' );
}

/**
 * The resolved meta description for the current request.
 *
 * Falls back to the excerpt, then trimmed content, so a page always has one.
 *
 * @return string
 */
function bc_seo_resolve_description() {
	$text = '';

	if ( is_front_page() ) {
		$text = bc_seo_option( 'home_description', get_bloginfo( 'description' ) );
	} elseif ( is_singular() ) {
		$id   = get_the_ID();
		$text = get_post_meta( $id, 'bc_seo_description', true );

		if ( ! $text ) {
			$text = has_excerpt( $id ) ? get_the_excerpt( $id ) : '';
		}
		if ( ! $text ) {
			$post = get_post( $id );
			$text = $post ? wp_strip_all_tags( strip_shortcodes( $post->post_content ) ) : '';
		}
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$text = get_term_meta( $term->term_id, 'bc_seo_description', true );
			if ( ! $text ) {
				$text = $term->description;
			}
		}
	}

	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $text ) ) );

	if ( mb_strlen( $text ) > 160 ) {
		$text = rtrim( mb_substr( $text, 0, 157 ), " ,.;:-" ) . '...';
	}

	return $text;
}

/**
 * Canonical URL for the current request.
 *
 * @return string
 */
function bc_seo_resolve_canonical() {
	if ( is_singular() ) {
		$custom = get_post_meta( get_the_ID(), 'bc_seo_canonical', true );
		if ( $custom ) {
			return esc_url_raw( $custom );
		}
		return get_permalink();
	}

	if ( is_front_page() ) {
		return home_url( '/' );
	}

	if ( is_tax() || is_category() || is_tag() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$link = get_term_link( $term );
			return is_wp_error( $link ) ? '' : $link;
		}
	}

	if ( is_post_type_archive() ) {
		return get_post_type_archive_link( get_query_var( 'post_type' ) );
	}

	return '';
}

/**
 * The image used for social previews.
 *
 * @return array{url:string,width:int,height:int,alt:string}|null
 */
function bc_seo_resolve_image() {
	$id = 0;

	if ( is_singular() ) {
		$id = (int) get_post_meta( get_the_ID(), 'bc_seo_og_image', true );
		if ( ! $id && has_post_thumbnail() ) {
			$id = get_post_thumbnail_id();
		}
	}

	if ( ! $id ) {
		$id = (int) bc_seo_option( 'default_og_id', 0 );
	}

	if ( $id ) {
		$src = wp_get_attachment_image_src( $id, 'full' );
		if ( $src ) {
			return array(
				'url'    => $src[0],
				'width'  => (int) $src[1],
				'height' => (int) $src[2],
				'alt'    => (string) get_post_meta( $id, '_wp_attachment_image_alt', true ),
			);
		}
	}

	// Last resort: the bundled hero, so social cards are never blank.
	return array(
		'url'    => BC_URI . '/assets/img/image11.jpg',
		'width'  => 1440,
		'height' => 628,
		'alt'    => get_bloginfo( 'name' ),
	);
}
