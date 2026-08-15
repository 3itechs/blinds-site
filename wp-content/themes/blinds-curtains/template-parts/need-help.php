<?php
/**
 * "Need Help ?" contact card (Figma node 2:1047).
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="bc-section bc-section--white bc-help">
	<div class="bc-container">
		<div class="bc-help__card">
			<img class="bc-help__bg" src="<?php echo esc_url( BC_URI . '/assets/img/rectangle10.jpg' ); ?>"
			     alt="" width="1280" height="410" loading="lazy" decoding="async" aria-hidden="true">

			<div class="bc-help__body">
				<h2 class="bc-help__title"><?php esc_html_e( 'Need Help ?', 'blinds-curtains' ); ?></h2>
				<p class="bc-help__lead"><?php esc_html_e( 'Out Team Is Always a Massage away.', 'blinds-curtains' ); ?></p>
				<p class="bc-help__text">
					<?php esc_html_e( 'Not sure which fabric suits a west-facing window, whether motorised blinds can be fitted to an existing room, or how long a made-to-measure order takes? Message us and a real advisor answers, usually within the hour. No call centre, no scripts, and no obligation to book a visit.', 'blinds-curtains' ); ?>
				</p>
				<a class="bc-btn bc-btn--outline" target="_blank" rel="noopener"
				   href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D/', '', bc_contact_details()['whatsapp'] ) ); ?>">
					<?php esc_html_e( 'WhatsApp Us', 'blinds-curtains' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
