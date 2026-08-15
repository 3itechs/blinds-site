<?php
/**
 * Template Name: About Us
 *
 * Figma node 2:1751.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'image' => 'image12.jpg',
	'title' => __( 'About us', 'blinds-curtains' ),
	'text'  => __( "Here at Satayir we are proud to be the UAE's no. 1 for blinds.", 'blinds-curtains' ),
	'cta'   => false,
) );

/**
 * The three alternating story blocks. `flip` puts the image on the right.
 */
$bc_blocks = array(
	array(
		'title' => __( 'Blinds and Curtains', 'blinds-curtains' ),
		'text'  => __( 'We make it easy to elevate your home with custom made curtains and blinds. The process is simple, digital and transparent. Enjoy flexible payment options including 3-month installments.', 'blinds-curtains' ),
		'image' => 'image4.jpg',
		'flip'  => false,
	),
	array(
		'title' => __( 'Our Expertise', 'blinds-curtains' ),
		'text'  => __( 'Our technicians have up to 20 years of experience in the curtains industry. They install everything and make sure every last screw is perfectly in place.', 'blinds-curtains' ),
		'image' => 'image7.jpg',
		'flip'  => true,
	),
	array(
		'title' => __( 'Our Commitment', 'blinds-curtains' ),
		'text'  => __( 'We treat every home like our own. We only work with top quality fabrics and accessories. Our customer success team will be there for you on every step of the process.', 'blinds-curtains' ),
		'image' => 'image2.jpg',
		'flip'  => false,
	),
);
?>

<section class="bc-section bc-section--page bc-journey">
	<div class="bc-container">
		<h2 class="bc-journey__title"><?php esc_html_e( 'Our Journey', 'blinds-curtains' ); ?></h2>

		<div class="bc-journey__body">
			<p><?php esc_html_e( 'Having spent 20 years in the UK retail industry, our Managing Partner, Shiraz, decided it was time for sunnier climes and moved to Dubai in 2014 with his family. The first office was a stunning waste of space on Sheikh Zayed Road, which gave Shiraz a fantastic view of Burj Khalifah, but chewed through his finances like water. School fees were duly paid and a move to a compact but cosy office in Port Saeed was home for the next 2 years.', 'blinds-curtains' ); ?></p>
			<p><?php esc_html_e( 'Like a lot of business people that move to Dubai, the first 2 years were painfully hard to adjust, but with the drive and ambition to succeed, and with a helping hand from God, things started to turn and the seeds that were laid in 2014 started bearing fruit.', 'blinds-curtains' ); ?></p>
			<p><?php esc_html_e( 'By 2017, we moved to our first actual showroom in Oud Metha. This is where things started to blow. Blinds and Curtains was now established as a firm favourite with hundreds of customers, most of whom would recommend us to their friends and families and also ended up being our return customers.', 'blinds-curtains' ); ?></p>
		</div>

		<figure class="bc-journey__banner">
			<img src="<?php echo esc_url( BC_URI . '/assets/img/image3.jpg' ); ?>"
			     alt="" width="1280" height="410" loading="lazy" decoding="async">
		</figure>
	</div>
</section>

<?php foreach ( $bc_blocks as $bc_block ) : ?>
	<section class="bc-section bc-section--white bc-split<?php echo $bc_block['flip'] ? ' bc-split--flip' : ''; ?>">
		<div class="bc-container">
			<div class="bc-split__layout">
				<figure class="bc-split__media">
					<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_block['image'] ); ?>"
					     alt="" width="620" height="500" loading="lazy" decoding="async">
				</figure>
				<div class="bc-split__body">
					<h2 class="bc-split__title"><?php echo esc_html( $bc_block['title'] ); ?></h2>
					<p class="bc-split__text"><?php echo esc_html( $bc_block['text'] ); ?></p>
					<a class="bc-btn bc-btn--cta" href="<?php echo esc_url( bc_appointment_url() ); ?>">
						<?php echo esc_html( bc_cta_label() ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
<?php endforeach; ?>

<?php
// The design closes on the testimonials — no booking form on this page.
get_template_part( 'template-parts/testimonials' );

get_footer();
