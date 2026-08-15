<?php
/**
 * "Our Happy Customer" testimonials (Figma nodes 2:1433 – 2:1482).
 *
 * Content is the business's real Google reviews. Every card shows five filled
 * stars because the profile stands at a straight 5.0 — see bc_home_testimonials().
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_rating = bc_review_summary();
?>
<section class="bc-section bc-section--white bc-testimonials">
	<div class="bc-container">

		<div class="bc-section-head">
			<h2 class="bc-testimonials__title"><?php esc_html_e( 'Our Happy Customer', 'blinds-curtains' ); ?></h2>
			<p class="bc-section-head__lead">
				<?php
				printf(
					/* translators: 1: average rating, 2: number of reviews */
					esc_html__( 'Rated %1$s from %2$s Google reviews. Here is what customers across Dubai said about the fit, the finish and the service.', 'blinds-curtains' ),
					esc_html( $bc_rating['average'] ),
					esc_html( $bc_rating['count'] )
				);
				?>
			</p>
		</div>

		<ul class="bc-testimonials__grid">
			<?php foreach ( bc_home_testimonials() as $bc_item ) : ?>
				<li class="bc-testimonial">

					<div class="bc-testimonial__head">
						<?php // Initials, not a stock face — the review belongs to a real person. ?>
						<span class="bc-testimonial__avatar" aria-hidden="true">
							<?php echo esc_html( bc_initials( $bc_item['name'] ) ); ?>
						</span>
						<div class="bc-testimonial__meta">
							<p class="bc-testimonial__name"><?php echo esc_html( $bc_item['name'] ); ?></p>
							<p class="bc-testimonial__rating">
								<?php for ( $bc_i = 0; $bc_i < 5; $bc_i++ ) : ?>
									<img src="<?php echo esc_url( BC_URI . '/assets/img/star1.svg' ); ?>" alt="" width="20" height="20">
								<?php endfor; ?>
								<?php if ( ! empty( $bc_item['when'] ) ) : ?>
									<span class="bc-testimonial__count"><?php echo esc_html( $bc_item['when'] ); ?></span>
								<?php endif; ?>
								<span class="screen-reader-text"><?php esc_html_e( 'Rated 5 out of 5', 'blinds-curtains' ); ?></span>
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
