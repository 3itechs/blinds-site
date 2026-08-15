<?php
/**
 * Template tags and content helpers.
 *
 * Defaults mirror the Figma design so the theme renders correctly on a fresh
 * install. Each is filterable, and the contact details read from Customizer
 * settings when they have been set.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build a srcset for a bundled theme photo.
 *
 * The image optimiser writes a "<name>-768.jpg" companion beside each large
 * photo. Real pixel widths are read once and cached, so the browser can pick
 * the small file on phones instead of downloading the full-width one.
 *
 * @param string $name Filename inside assets/img.
 * @return array{srcset:string,width:int,height:int} Empty srcset when no companion exists.
 */
function bc_photo_source( $name ) {
	$cache = get_transient( 'bc_photo_sizes' );
	if ( ! is_array( $cache ) ) {
		$cache = array();
	}

	if ( ! isset( $cache[ $name ] ) ) {
		$base = pathinfo( $name, PATHINFO_FILENAME );
		$ext  = pathinfo( $name, PATHINFO_EXTENSION );
		$full = BC_DIR . '/assets/img/' . $name;
		$sm   = BC_DIR . "/assets/img/{$base}-768.{$ext}";

		$entry = array( 'srcset' => '', 'width' => 0, 'height' => 0 );

		if ( file_exists( $full ) ) {
			$size = @getimagesize( $full );
			if ( $size ) {
				$entry['width']  = (int) $size[0];
				$entry['height'] = (int) $size[1];
			}

			if ( file_exists( $sm ) && $entry['width'] > 768 ) {
				$small = @getimagesize( $sm );
				if ( $small ) {
					$entry['srcset'] = sprintf(
						'%s %dw, %s %dw',
						BC_URI . "/assets/img/{$base}-768.{$ext}",
						(int) $small[0],
						BC_URI . '/assets/img/' . $name,
						$entry['width']
					);
				}
			}
		}

		$cache[ $name ] = $entry;
		set_transient( 'bc_photo_sizes', $cache, DAY_IN_SECONDS );
	}

	return $cache[ $name ];
}

/**
 * Echo srcset/sizes attributes for a bundled photo, if a companion exists.
 *
 * @param string $name  Filename inside assets/img.
 * @param string $sizes The `sizes` attribute value.
 */
function bc_photo_attrs( $name, $sizes = '100vw' ) {
	$source = bc_photo_source( $name );

	if ( ! $source['srcset'] ) {
		return;
	}

	printf(
		' srcset="%s" sizes="%s"',
		esc_attr( $source['srcset'] ),
		esc_attr( $sizes )
	);
}

/**
 * The four promises in the utility bar (Figma node 2:1057).
 *
 * @return array<int, array{icon:string,label:string}>
 */
function bc_topbar_promises() {
	return apply_filters( 'bc_topbar_promises', array(
		array( 'icon' => 'image5.png', 'label' => __( 'Price Promise', 'blinds-curtains' ) ),
		array( 'icon' => 'image6.png', 'label' => __( 'Fully Guaranteed', 'blinds-curtains' ) ),
		array( 'icon' => 'image.png',  'label' => __( 'Finance Options Available', 'blinds-curtains' ) ),
		array( 'icon' => 'image9.png', 'label' => __( 'Install in 2-3 days.', 'blinds-curtains' ) ),
	) );
}

/**
 * Brand lockup: orange rounded mark plus two-line wordmark.
 *
 * Uses the Customizer custom logo when one is set, otherwise the Figma mark.
 */
function bc_logo() {
	$home = esc_url( home_url( '/' ) );

	if ( has_custom_logo() ) {
		echo '<a class="bc-logo" href="' . $home . '" rel="home">';
		$logo_id = (int) get_theme_mod( 'custom_logo' );
		echo wp_get_attachment_image( $logo_id, 'full', false, array( 'alt' => esc_attr( get_bloginfo( 'name' ) ) ) );
		echo '</a>';
		return;
	}
	?>
	<a class="bc-logo" href="<?php echo $home; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above ?>" rel="home">
		<span class="bc-logo__mark">
			<img src="<?php echo esc_url( BC_URI . '/assets/img/group1707485822.svg' ); ?>" alt="" width="23" height="40">
		</span>
		<span class="bc-logo__text">
			<span><?php esc_html_e( 'Blind &', 'blinds-curtains' ); ?></span><br>
			<span><?php esc_html_e( 'Curtains', 'blinds-curtains' ); ?></span>
		</span>
		<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
	</a>
	<?php
}

/**
 * Destination for the header CTA and hero buttons.
 *
 * @return string
 */
function bc_appointment_url() {
	return apply_filters( 'bc_appointment_url', home_url( '/book-a-free-visit/' ) );
}

/**
 * The single label used by every button that leads to the booking page.
 *
 * The design shipped three different wordings for the same action ("Book Now",
 * "Book A Free Visit", "Book a Free Appointment"); routing them through one
 * function keeps the call to action consistent and changeable in one place.
 *
 * @return string
 */
function bc_cta_label() {
	return apply_filters( 'bc_cta_label', __( 'Book A Free Appointment', 'blinds-curtains' ) );
}

/**
 * Primary menu shown before the user assigns a menu in Appearance → Menus.
 */
function bc_primary_menu_fallback() {
	$items = array(
		__( 'Blinds', 'blinds-curtains' )                    => '/blinds/',
		__( 'Curtains', 'blinds-curtains' )                  => '/curtains/',
		__( 'Motorised', 'blinds-curtains' )                 => '/motorised/',
		__( 'Free in-Home Consultation', 'blinds-curtains' ) => '/free-in-home-consultation/',
		__( 'Gallery', 'blinds-curtains' )                   => '/gallery/',
		__( 'FAQs', 'blinds-curtains' )                      => '/faqs/',
		__( 'About Us', 'blinds-curtains' )                  => '/about-us/',
	);

	echo '<ul class="bc-nav__list">';
	foreach ( $items as $label => $path ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( home_url( $path ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Footer product links shown before a footer menu is assigned.
 */
function bc_footer_products_fallback() {
	$items = array(
		__( 'Blinds', 'blinds-curtains' )       => '/blinds/',
		__( 'Curtains', 'blinds-curtains' )     => '/curtains/',
		__( 'Motorisation', 'blinds-curtains' ) => '/motorised/',
	);

	echo '<ul class="bc-footer__links">';
	foreach ( $items as $label => $path ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( home_url( $path ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Footer blurb. The Figma file carries placeholder copy — real copy should be
 * set in Customizer → Site Identity once it exists.
 *
 * @return string
 */
function bc_footer_about() {
	$default = get_bloginfo( 'description' );

	if ( ! $default ) {
		$default = __( 'Made-to-measure blinds and curtains, manual or motorised, for homes and offices across Dubai. Free in-home consultation, free measuring and fitting, and installation within 2-3 days.', 'blinds-curtains' );
	}

	return apply_filters( 'bc_footer_about', get_theme_mod( 'bc_footer_about', $default ) );
}

/**
 * Aggregate Google rating, shown above the testimonials and published as
 * AggregateRating in the structured data.
 *
 * @return array{average:string,count:string}
 */
function bc_review_summary() {
	return apply_filters( 'bc_review_summary', array(
		'average' => get_theme_mod( 'bc_review_average', '5.0' ),
		'count'   => get_theme_mod( 'bc_review_count', '15' ),
	) );
}

/**
 * Initials for a reviewer's avatar disc, e.g. "Birgit Baur-Gallizioli" -> "BB".
 *
 * @param string $name Full name.
 * @return string One or two uppercase letters.
 */
function bc_initials( $name ) {
	$parts = preg_split( '/[\s\-]+/', trim( (string) $name ), -1, PREG_SPLIT_NO_EMPTY );
	if ( ! $parts ) {
		return '?';
	}

	$first = function_exists( 'mb_substr' ) ? mb_substr( $parts[0], 0, 1 ) : substr( $parts[0], 0, 1 );
	$last  = '';
	if ( count( $parts ) > 1 ) {
		$tail = end( $parts );
		$last = function_exists( 'mb_substr' ) ? mb_substr( $tail, 0, 1 ) : substr( $tail, 0, 1 );
	}

	return function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $first . $last ) : strtoupper( $first . $last );
}

/**
 * The postal address as one line.
 *
 * Built from the SEO business fields so the address shown on the page and the
 * address in the structured data can never disagree. Set it once under
 * SEO -> Business details.
 *
 * @return string
 */
function bc_business_address() {
	$custom = get_theme_mod( 'bc_address', '' );
	if ( $custom ) {
		return $custom;
	}

	if ( function_exists( 'bc_seo_settings' ) ) {
		$s     = bc_seo_settings();
		$parts = array_filter( array( $s['street'], $s['locality'], $s['region'], $s['postal_code'] ) );
		if ( $parts ) {
			return implode( ', ', array_unique( $parts ) );
		}
	}

	return __( 'Dubai, United Arab Emirates', 'blinds-curtains' );
}

/**
 * Contact details used in the footer pill row.
 *
 * @return array{phone:string,whatsapp:string,email:string}
 */
function bc_contact_details() {
	return apply_filters( 'bc_contact_details', array(
		'phone'    => get_theme_mod( 'bc_phone', '+971 000000000' ),
		'whatsapp' => get_theme_mod( 'bc_whatsapp', '+971 000000000' ),
		'email'    => get_theme_mod( 'bc_email', 'Email.website@gmail.com' ),
	) );
}

/**
 * Social profiles in the orange legal bar.
 *
 * @return array<int, array{id:string,label:string,url:string}>
 */
function bc_social_links() {
	return apply_filters( 'bc_social_links', array(
		array( 'id' => 'instagram', 'label' => 'Instagram', 'url' => get_theme_mod( 'bc_instagram', '#' ) ),
		array( 'id' => 'tiktok',    'label' => 'TikTok',    'url' => get_theme_mod( 'bc_tiktok', '#' ) ),
		array( 'id' => 'facebook',  'label' => 'Facebook',  'url' => get_theme_mod( 'bc_facebook', '#' ) ),
	) );
}

/**
 * Inline social glyph.
 *
 * @param string $id One of instagram, tiktok, facebook.
 * @return string SVG markup, or an empty string for an unknown id.
 */
function bc_social_icon( $id ) {
	$icons = array(
		'instagram' => '<path d="M8 1.4c2.1 0 2.4 0 3.3.05.8.03 1.2.16 1.5.27.37.14.64.32.92.6.28.28.46.55.6.92.11.3.24.7.27 1.5.04.9.05 1.2.05 3.3s0 2.4-.05 3.3c-.03.8-.16 1.2-.27 1.5a2.5 2.5 0 0 1-.6.92c-.28.28-.55.46-.92.6-.3.11-.7.24-1.5.27-.9.04-1.2.05-3.3.05s-2.4 0-3.3-.05c-.8-.03-1.2-.16-1.5-.27a2.5 2.5 0 0 1-.92-.6 2.5 2.5 0 0 1-.6-.92c-.11-.3-.24-.7-.27-1.5C1.4 10.4 1.4 10.1 1.4 8s0-2.4.05-3.3c.03-.8.16-1.2.27-1.5.14-.37.32-.64.6-.92.28-.28.55-.46.92-.6.3-.11.7-.24 1.5-.27C5.6 1.4 5.9 1.4 8 1.4Zm0 3.4a3.2 3.2 0 1 0 0 6.4 3.2 3.2 0 0 0 0-6.4Zm0 5.28a2.08 2.08 0 1 1 0-4.16 2.08 2.08 0 0 1 0 4.16Zm4.08-5.41a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>',
		'tiktok'    => '<path d="M11 1.4h-2.1v8.72a1.6 1.6 0 1 1-1.6-1.6c.17 0 .33.02.48.07V6.44a3.9 3.9 0 0 0-.48-.03 3.72 3.72 0 1 0 3.72 3.72V5.76c.72.5 1.58.8 2.5.82V4.47A2.7 2.7 0 0 1 11 1.4Z"/>',
		'facebook'  => '<path d="M14 8a6 6 0 1 0-6.94 5.93V9.74H5.54V8h1.52V6.68c0-1.5.9-2.33 2.26-2.33.65 0 1.34.12 1.34.12v1.47h-.76c-.74 0-.98.46-.98.94V8h1.67l-.27 1.74H8.92v4.19A6 6 0 0 0 14 8Z"/>',
	);

	if ( ! isset( $icons[ $id ] ) ) {
		return '';
	}

	return '<svg viewBox="0 0 16 16" aria-hidden="true" focusable="false">' . $icons[ $id ] . '</svg>';
}
