<?php
/**
 * Closing CTA banner — Figma "Frame 2147233282" on the Motorised page.
 *
 * A 1280x443 photo card inset in the container, with a dark scrim so the
 * centred white copy stays legible over the interior shot.
 *
 * Accepts $args: title, text, image, cta_url.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_title = isset( $args['title'] )
	? $args['title']
	: __( 'Upgrade Your Home with Blindandcurtains', 'blinds-curtains' );

$bc_text = isset( $args['text'] )
	? $args['text']
	: __( 'Experience seamless control and enhanced comfort, all at the touch of a button.', 'blinds-curtains' );

$bc_image   = isset( $args['image'] ) ? $args['image'] : 'image13.jpg';
$bc_cta_url = isset( $args['cta_url'] ) ? $args['cta_url'] : bc_appointment_url();
?>
<section class="bc-section bc-section--page bc-upgrade">
	<div class="bc-container">
		<div class="bc-upgrade__card">
			<img class="bc-upgrade__bg"
			     src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_image ); ?>"
			     alt="" width="1280" height="443" loading="lazy" decoding="async" aria-hidden="true"
			     <?php bc_photo_attrs( $bc_image, '(max-width: 1360px) 100vw, 1280px' ); ?>>

			<div class="bc-upgrade__body">
				<h2 class="bc-upgrade__title"><?php echo esc_html( $bc_title ); ?></h2>
				<p class="bc-upgrade__text"><?php echo esc_html( $bc_text ); ?></p>
				<a class="bc-btn bc-upgrade__cta" href="<?php echo esc_url( $bc_cta_url ); ?>">
					<?php echo esc_html( bc_cta_label() ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
