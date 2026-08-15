<?php
/**
 * FAQ accordion (Figma node 2:3012 lower band, reused on the FAQs page).
 *
 * The first item is open by default, matching the design.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_faqs  = bc_faqs();
$bc_title = isset( $args['title'] ) ? $args['title'] : __( 'Frequently Asked Questions', 'blinds-curtains' );
// The FAQs page sits the accordion on the cream band; product pages use grey.
$bc_bg    = ( isset( $args['bg'] ) && 'cream' === $args['bg'] ) ? 'bc-section--cream' : 'bc-section--page';
?>
<section class="bc-section <?php echo esc_attr( $bc_bg ); ?> bc-faq">
	<div class="bc-container">
		<h2 class="bc-faq__title"><?php echo esc_html( $bc_title ); ?></h2>

		<div class="bc-faq__list">
			<?php foreach ( $bc_faqs as $bc_i => $bc_faq ) : ?>
				<div class="bc-faq__item">
					<h3>
						<button type="button" class="bc-faq__q" aria-expanded="<?php echo 0 === $bc_i ? 'true' : 'false'; ?>"
						        aria-controls="bc-faq-<?php echo (int) $bc_i; ?>">
							<span><?php echo esc_html( $bc_faq['q'] ); ?></span>
							<span class="bc-faq__icon" aria-hidden="true"></span>
						</button>
					</h3>
					<div class="bc-faq__a" id="bc-faq-<?php echo (int) $bc_i; ?>" <?php echo 0 === $bc_i ? '' : 'hidden'; ?>>
						<p><?php echo esc_html( $bc_faq['a'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
