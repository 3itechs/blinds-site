<?php
/**
 * "Our Happy Customer" testimonials (Figma nodes 2:1433 – 2:1482).
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="bc-section bc-section--white bc-testimonials">
	<div class="bc-container">

		<div class="bc-section-head">
			<h2 class="bc-testimonials__title"><?php esc_html_e( 'Our Happy Customer', 'blinds-curtains' ); ?></h2>
			<p class="bc-section-head__lead">
				<?php esc_html_e( 'Homes, offices and villas across Dubai have had their windows dressed by our team. Here is what a few of them said about the fit, the finish and the service.', 'blinds-curtains' ); ?>
			</p>
		</div>

		<ul class="bc-testimonials__grid">
			<?php foreach ( bc_home_testimonials() as $bc_item ) : ?>
				<li class="bc-testimonial">

					<div class="bc-testimonial__head">
						<span class="bc-testimonial__avatar">
							<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_item['avatar'] ); ?>"
							     alt="" width="88" height="88" loading="lazy" decoding="async">
						</span>
						<div class="bc-testimonial__meta">
							<p class="bc-testimonial__name"><?php echo esc_html( $bc_item['name'] ); ?></p>
							<p class="bc-testimonial__rating">
								<?php
								// Four filled stars then the trailing partial star, as designed.
								for ( $bc_i = 0; $bc_i < 4; $bc_i++ ) :
									?>
									<img src="<?php echo esc_url( BC_URI . '/assets/img/star1.svg' ); ?>" alt="" width="20" height="20">
								<?php endfor; ?>
								<img src="<?php echo esc_url( BC_URI . '/assets/img/star5.svg' ); ?>" alt="" width="20" height="20">
								<span class="bc-testimonial__count"><?php echo esc_html( $bc_item['count'] ); ?></span>
								<span class="screen-reader-text"><?php esc_html_e( 'Rated 4.5 out of 5', 'blinds-curtains' ); ?></span>
							</p>
						</div>
					</div>

					<h3 class="bc-testimonial__subject"><?php echo esc_html( $bc_item['title'] ); ?></h3>
					<p class="bc-testimonial__text"><?php echo esc_html( $bc_item['text'] ); ?></p>

				</li>
			<?php endforeach; ?>
		</ul>

	</div>
</section>
