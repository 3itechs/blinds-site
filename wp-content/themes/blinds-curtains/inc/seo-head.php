<?php
/**
 * <head> output: title, description, canonical, robots, Open Graph, Twitter.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Replace the document title with the resolved SEO title.
 *
 * @param string $title Existing title.
 * @return string
 */
function bc_seo_document_title( $title ) {
	$resolved = bc_seo_resolve_title();
	$name     = get_bloginfo( 'name' );
	$sep      = bc_seo_option( 'title_separator', '|' );

	// A hand-written SEO title is used verbatim — it is already the full tag,
	// and appending the site name pushes most of them past the ~60 char
	// truncation point in search results.
	if ( is_front_page() && bc_seo_option( 'home_title' ) ) {
		return $resolved;
	}

	if ( is_singular() && get_post_meta( get_the_ID(), 'bc_seo_title', true ) ) {
		return $resolved;
	}

	if ( ( is_tax() || is_category() || is_tag() ) ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term && get_term_meta( $term->term_id, 'bc_seo_title', true ) ) {
			return $resolved;
		}
	}

	if ( $resolved === $name ) {
		return $name;
	}

	return $resolved . ' ' . $sep . ' ' . $name;
}
add_filter( 'pre_get_document_title', 'bc_seo_document_title', 20 );

/**
 * Emit the meta tags. Priority 1 so the description sits near the top of head.
 */
function bc_seo_head() {
	$desc      = bc_seo_resolve_description();
	$canonical = bc_seo_resolve_canonical();
	$settings  = bc_seo_settings();

	echo "\n<!-- SEO : blinds-curtains -->\n";

	if ( $desc ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	}

	// Keywords carry no ranking weight but some internal tools still read them.
	if ( is_singular() ) {
		$keywords = get_post_meta( get_the_ID(), 'bc_seo_keywords', true );
		if ( $keywords ) {
			printf( '<meta name="keywords" content="%s">' . "\n", esc_attr( $keywords ) );
		}
	}

	// Robots.
	$directives = array();
	$noindex    = is_singular() && get_post_meta( get_the_ID(), 'bc_seo_noindex', true );
	$nofollow   = is_singular() && get_post_meta( get_the_ID(), 'bc_seo_nofollow', true );

	if ( $noindex || is_search() || is_404() ) {
		$directives[] = 'noindex';
	} else {
		$directives[] = 'index';
	}
	$directives[] = $nofollow ? 'nofollow' : 'follow';

	// Let search and AI surfaces use full snippets and large previews.
	$directives[] = 'max-snippet:-1';
	$directives[] = 'max-image-preview:large';
	$directives[] = 'max-video-preview:-1';

	printf( '<meta name="robots" content="%s">' . "\n", esc_attr( implode( ', ', $directives ) ) );

	if ( $canonical ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonical ) );
	}

	if ( $settings['google_verify'] ) {
		printf( '<meta name="google-site-verification" content="%s">' . "\n", esc_attr( $settings['google_verify'] ) );
	}
	if ( $settings['bing_verify'] ) {
		printf( '<meta name="msvalidate.01" content="%s">' . "\n", esc_attr( $settings['bing_verify'] ) );
	}

	if ( empty( $settings['enable_og'] ) ) {
		echo "<!-- /SEO -->\n";
		return;
	}

	// ---- Open Graph -------------------------------------------------------
	$og_title = '';
	$og_desc  = '';

	if ( is_singular() ) {
		$og_title = get_post_meta( get_the_ID(), 'bc_seo_og_title', true );
		$og_desc  = get_post_meta( get_the_ID(), 'bc_seo_og_desc', true );
	}

	$og_title = $og_title ? $og_title : bc_seo_resolve_title();
	$og_desc  = $og_desc ? $og_desc : $desc;
	$image    = bc_seo_resolve_image();

	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:locale" content="%s">' . "\n", esc_attr( str_replace( '-', '_', get_bloginfo( 'language' ) ) ) );
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( is_singular( 'post' ) ? 'article' : 'website' ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $og_title ) );

	if ( $og_desc ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $og_desc ) );
	}
	if ( $canonical ) {
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $canonical ) );
	}
	if ( $image ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image['url'] ) );
		printf( '<meta property="og:image:width" content="%d">' . "\n", (int) $image['width'] );
		printf( '<meta property="og:image:height" content="%d">' . "\n", (int) $image['height'] );
		if ( $image['alt'] ) {
			printf( '<meta property="og:image:alt" content="%s">' . "\n", esc_attr( $image['alt'] ) );
		}
	}

	if ( is_singular( 'post' ) ) {
		printf( '<meta property="article:published_time" content="%s">' . "\n", esc_attr( get_the_date( DATE_W3C ) ) );
		printf( '<meta property="article:modified_time" content="%s">' . "\n", esc_attr( get_the_modified_date( DATE_W3C ) ) );
	}

	// ---- Twitter ----------------------------------------------------------
	printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $og_title ) );
	if ( $og_desc ) {
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $og_desc ) );
	}
	if ( $image ) {
		printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image['url'] ) );
	}
	if ( $settings['twitter_handle'] ) {
		$handle = '@' . ltrim( $settings['twitter_handle'], '@' );
		printf( '<meta name="twitter:site" content="%s">' . "\n", esc_attr( $handle ) );
	}

	echo "<!-- /SEO -->\n";
}
add_action( 'wp_head', 'bc_seo_head', 1 );

/**
 * Extend robots.txt with the sitemap and AI-crawler policy.
 *
 * @param string $output Existing robots.txt body.
 * @return string
 */
function bc_seo_robots_txt( $output ) {
	$lines = array( $output );

	if ( bc_seo_option( 'allow_ai_bots', 1 ) ) {
		// Explicit allow beats an implicit one for operators that look for it.
		foreach ( array( 'GPTBot', 'OAI-SearchBot', 'ChatGPT-User', 'ClaudeBot', 'Claude-User', 'PerplexityBot', 'Google-Extended', 'Applebot-Extended', 'CCBot' ) as $bot ) {
			$lines[] = "User-agent: {$bot}";
			$lines[] = 'Allow: /';
			$lines[] = '';
		}
	} else {
		foreach ( array( 'GPTBot', 'OAI-SearchBot', 'ClaudeBot', 'PerplexityBot', 'Google-Extended', 'Applebot-Extended', 'CCBot' ) as $bot ) {
			$lines[] = "User-agent: {$bot}";
			$lines[] = 'Disallow: /';
			$lines[] = '';
		}
	}

	// Core's sitemap server already appends a Sitemap line via this same filter,
	// so only add one when it is missing.
	$sitemap = 'Sitemap: ' . home_url( '/wp-sitemap.xml' );
	if ( false === strpos( $output, $sitemap ) ) {
		$lines[] = $sitemap;
	}

	if ( bc_seo_option( 'enable_llms', 1 ) ) {
		$lines[] = '# Site summary for language models: ' . home_url( '/llms.txt' );
	}

	return implode( "\n", $lines ) . "\n";
}
add_filter( 'robots_txt', 'bc_seo_robots_txt', 10, 1 );

/**
 * Plain-text helper: these files are not HTML, so entity-encoded output would
 * literally show "&amp;" to a crawler.
 *
 * @param string $text Possibly entity-encoded text.
 * @return string
 */
function bc_seo_plain( $text ) {
	return html_entity_decode( (string) $text, ENT_QUOTES, 'UTF-8' );
}

/**
 * Serve /llms.txt and /robots.txt.
 *
 * WordPress only routes robots.txt for root installs, and by the time
 * template_redirect fires the query has already resolved to a 404 — so both
 * the status code and the routing are handled explicitly here.
 */
function bc_seo_text_endpoints() {
	if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$path = wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH );
	if ( ! $path ) {
		return;
	}

	$file = strtolower( ltrim( basename( $path ), '/' ) );

	if ( 'robots.txt' === $file ) {
		status_header( 200 );
		header( 'Content-Type: text/plain; charset=utf-8' );
		$base = "User-agent: *\nDisallow: /wp-admin/\nAllow: /wp-admin/admin-ajax.php\n";
		echo bc_seo_plain( apply_filters( 'robots_txt', $base, true ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- plain text endpoint
		exit;
	}

	if ( 'llms.txt' !== $file ) {
		return;
	}

	if ( ! bc_seo_option( 'enable_llms', 1 ) ) {
		return;
	}

	status_header( 200 );
	nocache_headers();
	header( 'Content-Type: text/plain; charset=utf-8' );

	$name = bc_seo_plain( get_bloginfo( 'name' ) );
	$desc = bc_seo_plain( bc_seo_option( 'home_description', get_bloginfo( 'description' ) ) );

	$out   = array();
	$out[] = '# ' . $name;
	$out[] = '';
	if ( $desc ) {
		$out[] = '> ' . $desc;
		$out[] = '';
	}

	$settings = bc_seo_settings();
	$where    = array_filter( array( $settings['street'], $settings['locality'], $settings['region'] ) );
	if ( $where ) {
		$out[] = 'Location: ' . implode( ', ', $where );
	}
	if ( $settings['phone'] ) {
		$out[] = 'Phone: ' . $settings['phone'];
	}
	if ( $settings['opening_hours'] ) {
		$out[] = 'Hours: ' . $settings['opening_hours'];
	}
	$out[] = '';

	$out[] = '## Pages';
	foreach ( get_pages( array( 'sort_column' => 'menu_order,post_title' ) ) as $page ) {
		if ( get_post_meta( $page->ID, 'bc_seo_noindex', true ) ) {
			continue;
		}
		$summary = get_post_meta( $page->ID, 'bc_seo_description', true );
		$out[]   = '- [' . bc_seo_plain( $page->post_title ) . '](' . get_permalink( $page ) . ')'
			. ( $summary ? ': ' . bc_seo_plain( $summary ) : '' );
	}
	$out[] = '';

	$products = get_posts( array(
		'post_type'      => 'bc_product',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	) );

	if ( $products ) {
		$out[] = '## Products';
		foreach ( $products as $product ) {
			$price = get_post_meta( $product->ID, 'bc_price', true );
			$curr  = get_post_meta( $product->ID, 'bc_currency', true );
			$note  = $price ? ' (from ' . trim( $curr . ' ' . $price ) . ')' : '';
			$out[] = '- [' . bc_seo_plain( $product->post_title ) . '](' . get_permalink( $product ) . ')' . $note;
		}
		$out[] = '';
	}

	$out[] = '## Notes';
	$out[] = '- Structured data (JSON-LD) is embedded on every page.';
	$out[] = '- Sitemap: ' . home_url( '/wp-sitemap.xml' );

	echo implode( "\n", $out ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- plain text endpoint
	exit;
}
add_action( 'template_redirect', 'bc_seo_text_endpoints' );
