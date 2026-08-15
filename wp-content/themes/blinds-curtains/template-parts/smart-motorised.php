<?php
/**
 * Orange-panel-plus-photo band.
 *
 * Used twice with different copy: "Smart & Motorised" on the Gallery page and
 * "Electric Roman blinds" on the product category pages. The orange panel
 * occupies the left 725px of the 1440px artboard and the photo runs to the
 * right edge, so the band is a two-column grid with no container of its own.
 *
 * Accepts $args: title, lead, text, image, buttons (array of label => url).
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_title = isset( $args['title'] ) ? $args['title'] : __( 'Smart & Motorised', 'blinds-curtains' );
$bc_lead  = array_key_exists( 'lead', (array) $args )
	? $args['lead']
	: __( 'Move your blinds & curtains to your schedule', 'blinds-curtains' );
$bc_text  = isset( $args['text'] )
	? $args['text']
	: __( 'Did you know we can make your favourite Roman blind electric? Our electric blinds work with a remote and they’re smart compatible when you a buy a Somfy hub, so you can operate with an app on your phone or using voice control via Alexa or Google Assistant.', 'blinds-curtains' );
$bc_image = isset( $args['image'] ) ? $args['image'] : 'gal-smart.jpg';

$bc_buttons = isset( $args['buttons'] ) && is_array( $args['buttons'] )
	? $args['buttons']
	: array(
		__( 'Automated Blinds', 'blinds-curtains' )   => home_url( '/range/blinds/' ),
		__( 'Automated Curtains', 'blinds-curtains' ) => home_url( '/range/curtains/' ),
	);
?>
<section class="bc-smart">
	<div class="bc-smart__panel">
		<div class="bc-smart__body">
			<h2 class="bc-smart__title"><?php echo esc_html( $bc_title ); ?></h2>

			<?php if ( $bc_lead ) : ?>
				<p class="bc-smart__lead"><?php echo esc_html( $bc_lead ); ?></p>
			<?php endif; ?>

			<p class="bc-smart__text"><?php echo esc_html( $bc_text ); ?></p>

			<div class="bc-smart__actions">
				<?php foreach ( $bc_buttons as $bc_label => $bc_url ) : ?>
					<a class="bc-btn bc-smart__btn" href="<?php echo esc_url( $bc_url ); ?>">
						<?php echo esc_html( $bc_label ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<figure class="bc-smart__media">
		<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_image ); ?>"
		     alt="" width="715" height="595" loading="lazy" decoding="async">
	</figure>
</section>
