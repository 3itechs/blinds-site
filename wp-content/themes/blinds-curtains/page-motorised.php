<?php
/**
 * Template Name: Motorised
 *
 * Figma node 2:2454.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$bc_highlights = array(
	array(
		'title' => __( 'One-Touch Simplicity', 'blinds-curtains' ),
		'text'  => __( 'Raise, lower or tilt every covering in the room from a single remote — no cords, no reaching.', 'blinds-curtains' ),
	),
	array(
		'title' => __( 'Voice-Activated Control', 'blinds-curtains' ),
		'text'  => __( 'Works with Apple Home, Google Home, Alexa and SmartThings, so a spoken word sets the scene.', 'blinds-curtains' ),
	),
	array(
		'title' => __( 'Smart App Access', 'blinds-curtains' ),
		'text'  => __( 'Schedule shade and privacy around your day, and adjust the whole house while you are out.', 'blinds-curtains' ),
	),
	array(
		'title' => __( 'Quiet Motor', 'blinds-curtains' ),
		'text'  => __( 'Whisper-quiet motors move smoothly enough to run overnight without waking anyone.', 'blinds-curtains' ),
	),
);
?>

<section class="bc-motor-hero">
	<img src="<?php echo esc_url( BC_URI . '/assets/img/image12.jpg' ); ?>"
	     alt="" width="1440" height="500" fetchpriority="high" decoding="async">
	<span class="bc-motor-hero__play" aria-hidden="true">
		<svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
	</span>
</section>

<section class="bc-section bc-section--page bc-motor">
	<div class="bc-container">

		<div class="bc-section-head">
			<h1 class="bc-section-head__title"><?php esc_html_e( 'Intelligent Control, Seamlessly Connected', 'blinds-curtains' ); ?></h1>
			<p class="bc-section-head__lead">
				<?php esc_html_e( 'Transform the way you experience light and privacy with intelligent smart motorized window treatments.', 'blinds-curtains' ); ?>
			</p>
		</div>

		<div class="bc-motor__layout">
			<figure class="bc-motor__media">
				<img src="<?php echo esc_url( BC_URI . '/assets/img/image4.jpg' ); ?>"
				     alt="" width="620" height="420" loading="lazy" decoding="async">
				<span class="bc-motor-hero__play bc-motor-hero__play--sm" aria-hidden="true">
					<svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
				</span>
			</figure>

			<div class="bc-motor__panel">
				<h2 class="bc-motor__panel-title"><?php esc_html_e( 'Key Highlights', 'blinds-curtains' ); ?></h2>
				<p class="bc-motor__panel-lead">
					<?php esc_html_e( 'Effortless control via Apple Home, Google Home, Alexa, and SmartThings. Manage shade, ambiance, and privacy by voice or app.', 'blinds-curtains' ); ?>
				</p>

				<div class="bc-motor__list">
					<?php foreach ( $bc_highlights as $bc_i => $bc_hl ) : ?>
						<div class="bc-motor__row">
							<button type="button" class="bc-motor__q" aria-expanded="false" aria-controls="bc-hl-<?php echo (int) $bc_i; ?>">
								<span class="bc-motor__icon" aria-hidden="true">
									<svg viewBox="0 0 24 24"><path d="M12 3a9 9 0 0 1 9 9h-2a7 7 0 0 0-7-7V3Zm0 4a5 5 0 0 1 5 5h-2a3 3 0 0 0-3-3V7Zm0 4a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z"/></svg>
								</span>
								<span class="bc-motor__label"><?php echo esc_html( $bc_hl['title'] ); ?></span>
								<span class="bc-motor__chev" aria-hidden="true"></span>
							</button>
							<div class="bc-motor__a" id="bc-hl-<?php echo (int) $bc_i; ?>" hidden>
								<p><?php echo esc_html( $bc_hl['text'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

	</div>
</section>

<section class="bc-section bc-section--white bc-split bc-split--flip">
	<div class="bc-container">
		<div class="bc-split__layout">
			<figure class="bc-split__media">
				<img src="<?php echo esc_url( BC_URI . '/assets/img/image7.jpg' ); ?>"
				     alt="" width="620" height="440" loading="lazy" decoding="async">
			</figure>
			<div class="bc-split__body">
				<h2 class="bc-split__title"><?php esc_html_e( 'Motorised Blinds', 'blinds-curtains' ); ?></h2>
				<p class="bc-split__text">
					<?php esc_html_e( 'We treat every home like our own. We only work with top quality fabrics and accessories. Our customer success team will be there for you on every step of the process.', 'blinds-curtains' ); ?>
				</p>
				<a class="bc-btn bc-btn--cta" href="<?php echo esc_url( home_url( '/range/blinds/' ) ); ?>">
					<?php esc_html_e( 'Explore Blinds', 'blinds-curtains' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<section class="bc-section bc-section--white bc-split">
	<div class="bc-container">
		<div class="bc-split__layout">
			<figure class="bc-split__media">
				<img src="<?php echo esc_url( BC_URI . '/assets/img/image2.jpg' ); ?>"
				     alt="" width="620" height="440" loading="lazy" decoding="async">
			</figure>
			<div class="bc-split__body">
				<h2 class="bc-split__title"><?php esc_html_e( 'Motorised Curtains', 'blinds-curtains' ); ?></h2>
				<p class="bc-split__text">
					<?php esc_html_e( 'Silent tracks and app scheduling let full-height curtains open with the morning and close at sunset, without anyone lifting a hand.', 'blinds-curtains' ); ?>
				</p>
				<a class="bc-btn bc-btn--cta" href="<?php echo esc_url( home_url( '/range/curtains/' ) ); ?>">
					<?php esc_html_e( 'Explore Curtains', 'blinds-curtains' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
// The design ends on the FAQ and the closing banner — no testimonials or
// booking form on this page.
get_template_part( 'template-parts/faq' );
get_template_part( 'template-parts/upgrade-cta' );

get_footer();
