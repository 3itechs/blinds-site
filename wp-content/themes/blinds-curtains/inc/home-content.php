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
 * Testimonials — real Google Business Profile reviews for Dubai Blinds And
 * Curtains, which holds 5.0 from 15 reviews.
 *
 * Names and wording are quoted as written. The two longer entries are cut at a
 * sentence boundary where Google itself truncated them. Avatars are reviewer
 * initials rather than photographs: their Google profile pictures are not ours
 * to republish, and stock faces would misrepresent who wrote the review.
 *
 * @return array<int, array<string, string>>
 */
function bc_home_testimonials() {
	return apply_filters( 'bc_home_testimonials', array(
		array(
			'name'  => __( 'Shilpa Susan Jacob', 'blinds-curtains' ),
			'when'  => __( '2 months ago', 'blinds-curtains' ),
			'title' => __( 'Curtain Blinds, Windows & Door', 'blinds-curtains' ),
			'text'  => __( 'Excellent service from start to finish! The team installed curtain blinds for our windows and door professionally and efficiently. They completed the work on time, stayed within the agreed budget, and delivered a neat, quality finish.', 'blinds-curtains' ),
		),
		array(
			'name'  => __( 'Dovile Tamkutonyte', 'blinds-curtains' ),
			'when'  => __( 'a month ago', 'blinds-curtains' ),
			'title' => __( 'Sunscreen Blinds, Villa', 'blinds-curtains' ),
			'text'  => __( 'Shahbaz and his team did an amazing job today at our villa with installing sunscreen blinds. Very polite, knowledgeable and professional. Excellent work! Highly recommended!!!', 'blinds-curtains' ),
		),
		array(
			'name'  => __( 'Birgit Baur-Gallizioli', 'blinds-curtains' ),
			'when'  => __( '3 months ago', 'blinds-curtains' ),
			'title' => __( 'Returning Customer', 'blinds-curtains' ),
			'text'  => __( 'Had recently another very good experience with the Shabaz team. Punctually, clean work, with a patience of an Elefant during the decision process. Making almost miracles to hide a 2 cm difference in room heights. Will always use this team again.', 'blinds-curtains' ),
		),
		array(
			'name'  => __( 'Canaan Joseph', 'blinds-curtains' ),
			'when'  => __( '3 months ago', 'blinds-curtains' ),
			'title' => __( 'Amazing Quality Curtains', 'blinds-curtains' ),
			'text'  => __( 'Amazing quality curtains, Shahbaz and his team did a wonderful job extremely quick and professional.', 'blinds-curtains' ),
		),
	) );
}
