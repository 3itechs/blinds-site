<?php
/**
 * Book a Appointment form (Figma node 2:1318).
 *
 * Reused on Home and the booking pages. Submission handling is registered in
 * inc/appointment.php.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_status = isset( $_GET['appointment'] ) ? sanitize_key( wp_unslash( $_GET['appointment'] ) ) : '';

// "bare" drops the full-width cream band so the form can sit inside a panel
// that already provides its own background (Book A Free Visit, node 2:1527).
$bc_bare = ! empty( $args['bare'] );
?>
<section class="bc-appointment<?php echo $bc_bare ? ' bc-appointment--bare' : ''; ?>" id="book-appointment">
	<div class="<?php echo $bc_bare ? 'bc-appointment__inner' : 'bc-container'; ?>">

		<h2 class="bc-appointment__title"><?php esc_html_e( 'Book a Appointment', 'blinds-curtains' ); ?></h2>

		<?php if ( 'sent' === $bc_status ) : ?>
			<p class="bc-appointment__notice" role="status">
				<?php esc_html_e( 'Thanks — your request has been sent. We will be in touch shortly.', 'blinds-curtains' ); ?>
			</p>
		<?php elseif ( 'error' === $bc_status ) : ?>
			<p class="bc-appointment__notice bc-appointment__notice--error" role="alert">
				<?php esc_html_e( 'Sorry, something went wrong. Please check the required fields and try again.', 'blinds-curtains' ); ?>
			</p>
		<?php endif; ?>

		<form class="bc-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="bc_appointment">
			<input type="hidden" name="redirect_to" value="<?php echo esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ); ?>">
			<?php wp_nonce_field( 'bc_appointment', 'bc_appointment_nonce' ); ?>

			<div class="bc-form__grid">

				<div class="bc-field">
					<label for="bc-name"><?php esc_html_e( 'Name', 'blinds-curtains' ); ?></label>
					<input type="text" id="bc-name" name="bc_name" placeholder="<?php esc_attr_e( 'Enter Your Name', 'blinds-curtains' ); ?>" required>
				</div>

				<div class="bc-field">
					<label for="bc-phone"><?php esc_html_e( 'Phone Number', 'blinds-curtains' ); ?></label>
					<input type="tel" id="bc-phone" name="bc_phone" placeholder="+97" required>
				</div>

				<div class="bc-field">
					<label for="bc-email"><?php esc_html_e( 'E-mail', 'blinds-curtains' ); ?></label>
					<input type="email" id="bc-email" name="bc_email" placeholder="<?php esc_attr_e( 'Enter Your Email', 'blinds-curtains' ); ?>" required>
				</div>

				<div class="bc-field">
					<label for="bc-whatsapp"><?php esc_html_e( 'WhatsApp No', 'blinds-curtains' ); ?></label>
					<input type="tel" id="bc-whatsapp" name="bc_whatsapp" placeholder="+97">
				</div>

				<div class="bc-field">
					<label for="bc-windows"><?php esc_html_e( 'How Many Window', 'blinds-curtains' ); ?></label>
					<input type="number" min="1" id="bc-windows" name="bc_windows" placeholder="<?php esc_attr_e( 'Enter No Of Window', 'blinds-curtains' ); ?>">
				</div>

				<div class="bc-field">
					<label for="bc-date"><?php esc_html_e( 'Preferred Date', 'blinds-curtains' ); ?></label>
					<input type="date" id="bc-date" name="bc_date" placeholder="01/01/25">
				</div>

				<div class="bc-field">
					<label for="bc-time"><?php esc_html_e( 'Preferred Time', 'blinds-curtains' ); ?></label>
					<input type="time" id="bc-time" name="bc_time" placeholder="PM">
				</div>

				<div class="bc-field">
					<label for="bc-source"><?php esc_html_e( 'You Here About Us?', 'blinds-curtains' ); ?></label>
					<select id="bc-source" name="bc_source">
						<option value=""><?php esc_html_e( 'Select....', 'blinds-curtains' ); ?></option>
						<option value="google"><?php esc_html_e( 'Google', 'blinds-curtains' ); ?></option>
						<option value="instagram"><?php esc_html_e( 'Instagram', 'blinds-curtains' ); ?></option>
						<option value="facebook"><?php esc_html_e( 'Facebook', 'blinds-curtains' ); ?></option>
						<option value="referral"><?php esc_html_e( 'Friend or family', 'blinds-curtains' ); ?></option>
						<option value="other"><?php esc_html_e( 'Other', 'blinds-curtains' ); ?></option>
					</select>
				</div>

				<div class="bc-field bc-field--full">
					<label for="bc-address"><?php esc_html_e( 'Address', 'blinds-curtains' ); ?></label>
					<input type="text" id="bc-address" name="bc_address" placeholder="<?php esc_attr_e( 'Enter You Address', 'blinds-curtains' ); ?>">
				</div>

			</div>

			<fieldset class="bc-form__needs">
				<legend><?php esc_html_e( 'Tell Me What You Need:', 'blinds-curtains' ); ?></legend>
				<div class="bc-checks">
					<?php
					$bc_needs = array(
						'blinds'   => __( 'Blinds', 'blinds-curtains' ),
						'curtains' => __( 'Curtains', 'blinds-curtains' ),
						// Shutters removed — not a product we supply.
						'motorised' => __( 'Motorised', 'blinds-curtains' ),
					);
					foreach ( $bc_needs as $bc_key => $bc_label ) :
						?>
						<label class="bc-check">
							<input type="checkbox" name="bc_needs[]" value="<?php echo esc_attr( $bc_key ); ?>">
							<span><?php echo esc_html( $bc_label ); ?></span>
						</label>
					<?php endforeach; ?>
				</div>
			</fieldset>

			<div class="bc-field bc-field--full">
				<label for="bc-query"><?php esc_html_e( 'Any Other Requirement', 'blinds-curtains' ); ?></label>
				<input type="text" id="bc-query" name="bc_query" maxlength="350"
				       placeholder="<?php esc_attr_e( 'Enter Your Query (max 350 Characters )', 'blinds-curtains' ); ?>">
			</div>

			<?php // Honeypot: bots fill it, humans never see it. ?>
			<p class="bc-hp" aria-hidden="true">
				<label for="bc-website"><?php esc_html_e( 'Leave this field empty', 'blinds-curtains' ); ?></label>
				<input type="text" id="bc-website" name="bc_website" tabindex="-1" autocomplete="off">
			</p>

			<div class="bc-form__submit">
				<button type="submit" class="bc-btn bc-btn--primary">
					<?php esc_html_e( 'Submit Request', 'blinds-curtains' ); ?>
				</button>
			</div>

		</form>
	</div>
</section>
