<?php
/**
 * "Fully Guaranteed For Your Peace Of Mind" split — Gallery design.
 *
 * Illustration on the left, copy and a Read More button on the right.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="bc-section bc-section--page bc-guarantee">
	<div class="bc-container">
		<div class="bc-guarantee__layout">

			<figure class="bc-guarantee__media">
				<img src="<?php echo esc_url( BC_URI . '/assets/img/gal-guarantee.jpg' ); ?>"
				     alt="" width="620" height="520" loading="lazy" decoding="async">
			</figure>

			<div class="bc-guarantee__body">
				<h2 class="bc-guarantee__title"><?php esc_html_e( 'Fully Guaranteed For Your Peace Of Mind', 'blinds-curtains' ); ?></h2>
				<p class="bc-guarantee__text">
					<?php esc_html_e( 'All our made-to-measure blinds and curtains come with a 10-year warranty on all hardware and a 5-year warranty on all fabrics. You can rest assured you’re investing in quality products.', 'blinds-curtains' ); ?>
				</p>
				<a class="bc-btn bc-btn--cta bc-guarantee__cta" href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">
					<?php esc_html_e( 'Read More...', 'blinds-curtains' ); ?>
				</a>
			</div>

		</div>
	</div>
</section>
