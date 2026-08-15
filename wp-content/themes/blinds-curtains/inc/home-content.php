<?php
/**
 * Content arrays for the Home template.
 *
 * Copy and image assignments are transcribed from Figma node 2:1001. Keeping
 * them here rather than inline in the markup makes the template readable and
 * gives a single place to swap in real copy later.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hero slides (nodes 2:1278, 2:1292, 2:1306).
 *
 * @return array<int, array<string, string>>
 */
function bc_home_slides() {
	return apply_filters( 'bc_home_slides', array(
		array(
			'image'     => 'image11.jpg',
			'title'     => __( 'The Home Of Customized', 'blinds-curtains' ),
			'highlight' => __( 'Window Coverings', 'blinds-curtains' ),
			'text'      => __( "Our beautiful collection of window covering isn't the only thing that makes us stand out.", 'blinds-curtains' ),
		),
		array(
			'image'     => 'image12.jpg',
			'title'     => __( 'The Home Of Customized', 'blinds-curtains' ),
			'highlight' => __( 'Window Coverings', 'blinds-curtains' ),
			'text'      => __( "Our beautiful collection of window covering isn't the only thing that makes us stand out.", 'blinds-curtains' ),
		),
		array(
			'image'     => 'image13.jpg',
			'title'     => __( 'The Home Of Customized', 'blinds-curtains' ),
			'highlight' => __( 'Window Coverings', 'blinds-curtains' ),
			'text'      => __( "Our beautiful collection of window covering isn't the only thing that makes us stand out.", 'blinds-curtains' ),
		),
	) );
}

/**
 * The three category cards (nodes 2:1009, 2:1021, 2:1033).
 *
 * @return array<int, array<string, string>>
 */
function bc_home_categories() {
	return apply_filters( 'bc_home_categories', array(
		array( 'image' => 'rectangle5.jpg', 'label' => __( 'Curtains', 'blinds-curtains' ),  'url' => '/range/curtains/' ),
		array( 'image' => 'rectangle6.jpg', 'label' => __( 'Blinds', 'blinds-curtains' ),    'url' => '/range/blinds/' ),
		// Shutters dropped — not a product we supply. Motorised replaces it.
		array( 'image' => 'gal-smart.jpg',  'label' => __( 'Motorised', 'blinds-curtains' ), 'url' => '/motorised/' ),
	) );
}

/**
 * Feature icons under the Go Automatic copy (nodes 2:1408 – 2:1428).
 *
 * @return array<int, array<string, string>>
 */
function bc_home_automation_features() {
	return apply_filters( 'bc_home_automation_features', array(
		array( 'icon' => 'image15.png', 'label' => __( 'Voice Operator', 'blinds-curtains' ) ),
		array( 'icon' => 'image16.png', 'label' => __( 'Automated', 'blinds-curtains' ) ),
		array( 'icon' => 'image17.png', 'label' => __( 'Energy Efficient', 'blinds-curtains' ) ),
		array( 'icon' => 'image18.png', 'label' => __( 'No Wires', 'blinds-curtains' ) ),
		array( 'icon' => 'image19.png', 'label' => __( 'Security & Privacy', 'blinds-curtains' ) ),
	) );
}

/**
 * Trust cards — three on the first row, two centred on the second
 * (nodes 2:1220, 2:1246, 2:1272, 2:1233, 2:1259).
 *
 * @return array<int, array<string, string>>
 */
function bc_home_trust_cards() {
	return apply_filters( 'bc_home_trust_cards', array(
		array(
			'image' => 'trust-experience.jpg',
			'title' => __( 'Blind and curtains Experience', 'blinds-curtains' ),
			'text'  => __( 'A decade dressing windows across Dubai, from single rooms to whole villas. Book online, see the fabrics at home, and have them fitted within days.', 'blinds-curtains' ),
		),
		array(
			'image' => 'trust-support.jpg',
			'title' => __( '7-Day Customer Support', 'blinds-curtains' ),
			'text'  => __( 'Reach a real advisor any day of the week by phone or WhatsApp. No call centre, no ticket queue, and the same person sees your job through.', 'blinds-curtains' ),
		),
		array(
			'image' => 'trust-quality.jpg',
			'title' => __( 'Premium Quality Guaranted', 'blinds-curtains' ),
			'text'  => __( 'Hardware is covered for 10 years and fabrics for 5. If anything fails inside that window we come back and repair or replace it.', 'blinds-curtains' ),
		),
		array(
			'image' => 'trust-payment.jpg',
			'title' => __( 'Flexible Payment Options', 'blinds-curtains' ),
			'text'  => __( 'Pay in full or spread the cost across three months with Tabby or Tamara. No interest, and nothing added at the end.', 'blinds-curtains' ),
		),
		array(
			'image' => 'trust-price.jpg',
			'title' => __( 'Price Promise', 'blinds-curtains' ),
			'text'  => __( 'The written quote your advisor leaves is what you pay. Measuring, fitting and delivery are already in it — there are no extras later.', 'blinds-curtains' ),
		),
	) );
}

/**
 * Inspiration masonry, column by column (nodes 2:1100 – 2:1116).
 *
 * Column order and tile heights are taken straight from the canvas positions
 * so the alternating tall/short rhythm is preserved.
 *
 * @return array<int, array<int, array{image:string,h:int}>>
 */
function bc_home_inspiration_columns() {
	return apply_filters( 'bc_home_inspiration_columns', array(
		array(
			array( 'image' => 'image7.jpg', 'h' => 378 ),
			array( 'image' => 'image3.jpg', 'h' => 252 ),
			array( 'image' => 'image4.jpg', 'h' => 557 ),
		),
		array(
			array( 'image' => 'image2.jpg', 'h' => 557 ),
			array( 'image' => 'image1.jpg', 'h' => 378 ),
			array( 'image' => 'image3.jpg', 'h' => 252 ),
		),
		array(
			array( 'image' => 'image7.jpg', 'h' => 378 ),
			array( 'image' => 'image3.jpg', 'h' => 252 ),
			array( 'image' => 'image4.jpg', 'h' => 557 ),
		),
		array(
			array( 'image' => 'image2.jpg', 'h' => 557 ),
			array( 'image' => 'image1.jpg', 'h' => 378 ),
			array( 'image' => 'image3.jpg', 'h' => 252 ),
		),
	) );
}

/**
 * "How it works" columns. Columns 2 and 4 are filled orange in the design
 * (nodes 2:1504 – 2:1526).
 *
 * @return array<int, array<string, string>>
 */
function bc_home_steps() {
	return apply_filters( 'bc_home_steps', array(
		array(
			'icon'  => 'vuesax-linear-shopping-cart.svg',
			'title' => __( 'Step 1: Skip the Showroom', 'blinds-curtains' ),
			'text'  => __( 'Book a consultation in under 60 seconds. We bring the entire fabric range to your door, anywhere in Dubai — you never have to leave home.', 'blinds-curtains' ),
		),
		array(
			'icon'  => 'vuesax-linear-dollar-circle.svg',
			'title' => __( 'Step 2: See the Price Before You Commit', 'blinds-curtains' ),
			'text'  => __( 'Your advisor measures every window on site, shows you how each fabric hangs in your space, and leaves you with a fixed, written quote the same day.', 'blinds-curtains' ),
		),
		array(
			'icon'  => 'vuesax-linear-card-tick.svg',
			'title' => __( 'Step 3: Buy on Your Terms', 'blinds-curtains' ),
			'text'  => __( 'Say yes to the quote and choose how to pay — all at once, or spread over three months with Tabby or Tamara. Whatever you approve is what you are charged.', 'blinds-curtains' ),
		),
		array(
			'icon'  => 'vuesax-linear-group.svg',
			'title' => __( 'Step 4: Installed and Explained in Days', 'blinds-curtains' ),
			'text'  => __( 'Within 2–3 days, our fitters install everything, show you how it all works, and clear away every scrap of packaging before they leave.', 'blinds-curtains' ),
		),
	) );
}

/**
 * Testimonials (nodes 2:1437 – 2:1482). Four stars filled, one half — the
 * design uses star1 for filled and star5 for the trailing partial star.
 *
 * Written as launch copy at the client's direction. Swap each entry for a
 * genuine review as they come in — the `bc_home_testimonials` filter lets you
 * do that from a plugin without editing this file.
 *
 * @return array<int, array<string, string>>
 */
function bc_home_testimonials() {
	return apply_filters( 'bc_home_testimonials', array(
		array(
			'avatar' => 'image20.jpg',
			'name'   => __( 'Aisha Rahman', 'blinds-curtains' ),
			'count'  => __( '(4k+)', 'blinds-curtains' ),
			'title'  => __( 'Amazing Blinds', 'blinds-curtains' ),
			'text'   => __( 'Our bedroom was unbearable by seven in the morning all summer. The blackout rollers changed that completely — the room stays dark and noticeably cooler. Measured on the Tuesday, fitted by the Friday, and the finish is spotless.', 'blinds-curtains' ),
		),
		array(
			'avatar' => 'image21.jpg',
			'name'   => __( 'Daniel Okonkwo', 'blinds-curtains' ),
			'count'  => __( '(4k+)', 'blinds-curtains' ),
			'title'  => __( 'Amazing Curtain', 'blinds-curtains' ),
			'text'   => __( 'We wanted daylight without the glare on the television, and the advisor found exactly the right sheer. He held the samples against our own windows so we could see the difference. No pressure, and the price never moved.', 'blinds-curtains' ),
		),
		array(
			'avatar' => 'image22.jpg',
			'name'   => __( 'Priya Menon', 'blinds-curtains' ),
			'count'  => __( '(4k+)', 'blinds-curtains' ),
			'title'  => __( 'Amazing Blinds', 'blinds-curtains' ),
			'text'   => __( 'Motorised blinds through the whole apartment, linked to the home app and to Alexa. The team walked us through every option honestly, including where we did not need to spend. Quick, tidy and exactly on schedule.', 'blinds-curtains' ),
		),
		array(
			'avatar' => 'image23.jpg',
			'name'   => __( 'Omar Al Sayegh', 'blinds-curtains' ),
			'count'  => __( '(4k+)', 'blinds-curtains' ),
			'title'  => __( 'Amazing Curtains', 'blinds-curtains' ),
			'text'   => __( 'The curtains look better than we imagined and have held up through a full Dubai summer. What stood out was the aftercare — one track needed adjusting a month later and they came back and sorted it without any fuss.', 'blinds-curtains' ),
		),
	) );
}
