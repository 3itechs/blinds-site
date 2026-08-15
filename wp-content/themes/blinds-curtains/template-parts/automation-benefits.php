<?php
/**
 * Three automation benefit cards — Gallery design, below the Smart band.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_benefits = array(
	array(
		'image' => 'gal-feat-convenience.jpg',
		'title' => __( 'Added Convenience', 'blinds-curtains' ),
		'text'  => __( "A luxurious addition to your home that lets you set timers, create scenes, and makes you wonder why you didn't switch your blinds and curtains sooner.", 'blinds-curtains' ),
	),
	array(
		'image' => 'gal-feat-compatible.jpg',
		'title' => __( 'Compatible with all major smart homes systems', 'blinds-curtains' ),
		'text'  => __( 'Talk to our specialists today to find the best option for your blinds & curtains, whether it’s a remote, Alexa, Google Home, or Apple HomeKit.', 'blinds-curtains' ),
	),
	array(
		'image' => 'gal-feat-energy.jpg',
		'title' => __( 'Energy Efficient', 'blinds-curtains' ),
		'text'  => __( 'Live comfortably and save energy with blinds and curtains automation that helps keep your room warm in winter and cool in summer.', 'blinds-curtains' ),
	),
);
?>
<section class="bc-section bc-section--white bc-benefits">
	<div class="bc-container">
		<ul class="bc-benefits__grid">
			<?php foreach ( $bc_benefits as $bc_item ) : ?>
				<li class="bc-benefit">
					<figure class="bc-benefit__media">
						<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_item['image'] ); ?>"
						     alt="" width="410" height="230" loading="lazy" decoding="async">
					</figure>
					<h3 class="bc-benefit__title"><?php echo esc_html( $bc_item['title'] ); ?></h3>
					<p class="bc-benefit__text"><?php echo esc_html( $bc_item['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
