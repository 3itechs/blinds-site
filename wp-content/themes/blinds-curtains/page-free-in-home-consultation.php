<?php
/**
 * Template Name: Free in-Home Consultation
 *
 * Rebuilt from the supplied design: hero with two actions, a three-step
 * "how it works" row, the manage-appointment strip, the lifetime guarantee
 * band, a real-projects masonry and the social wall.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$bc_steps = array(
	array(
		'image' => 'consult-step-1.jpg',
		'title' => __( 'Make An Appointment', 'blinds-curtains' ),
		'text'  => __( 'Use our booking tool to find a time that works for you and to give us an idea of what you are looking for.', 'blinds-curtains' ),
	),
	array(
		'image' => 'consult-step-2.jpg',
		'title' => __( 'We Bring the Showroom to You', 'blinds-curtains' ),
		'text'  => __( 'Discuss inspiration, explore materials, and get personalized solutions that best fit your space.', 'blinds-curtains' ),
	),
	array(
		'image' => 'consult-step-3.jpg',
		'title' => __( 'Watch It Come Together', 'blinds-curtains' ),
		'text'  => __( 'From order placement to scheduling your installation, we will provide it all right on budget.', 'blinds-curtains' ),
	),
);

// Masonry columns for "Real Projects by Real Designers".
$bc_projects = array(
	array( 'image1.jpg', 'image3.jpg', 'image2.jpg' ),
	array( 'gal-tile-05.jpg', 'image7.jpg', 'gal-tile-10.jpg' ),
	array( 'image4.jpg', 'gal-tile-11.jpg', 'image8.jpg' ),
);

$bc_social = array(
	'gal-tile-01.jpg', 'gal-tile-05.jpg', 'gal-tile-09.jpg',
	'image2.jpg', 'gal-tile-03.jpg', 'image7.jpg',
	'gal-tile-12.jpg', 'image1.jpg', 'gal-tile-02.jpg',
);
?>

<?php // ------------------------------------------------------------- Hero ?>
<section class="bc-page-hero bc-page-hero--consult">
	<img class="bc-page-hero__image" src="<?php echo esc_url( BC_URI . '/assets/img/consult-hero.jpg' ); ?>"
	     alt="" width="1440" height="628" fetchpriority="high" decoding="async">

	<div class="bc-page-hero__card">
		<h1 class="bc-page-hero__title">
			<span class="bc-page-hero__title-accent"><?php esc_html_e( 'Free In-Home', 'blinds-curtains' ); ?></span>
			<span><?php esc_html_e( 'Design Appointment', 'blinds-curtains' ); ?></span>
		</h1>
		<a class="bc-btn bc-btn--primary" href="<?php echo esc_url( bc_appointment_url() ); ?>">
			<?php esc_html_e( 'Check Availability', 'blinds-curtains' ); ?>
		</a>
		<a class="bc-page-hero__link" href="<?php echo esc_url( bc_appointment_url() ); ?>">
			<?php esc_html_e( 'Manage Existing', 'blinds-curtains' ); ?>
		</a>
	</div>
</section>

<?php // ------------------------------------------------------- How it works ?>
<section class="bc-section bc-section--white bc-consult">
	<div class="bc-container">
		<div class="bc-section-head">
			<h2 class="bc-section-head__title">
				<?php esc_html_e( 'We’ve got every project covered. Here’s how it works', 'blinds-curtains' ); ?>
			</h2>
		</div>

		<ul class="bc-consult__grid">
			<?php foreach ( $bc_steps as $bc_step ) : ?>
				<li class="bc-consult__step">
					<figure>
						<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_step['image'] ); ?>"
						     alt="" width="410" height="250" loading="lazy" decoding="async">
					</figure>
					<h3><?php echo esc_html( $bc_step['title'] ); ?></h3>
					<p><?php echo esc_html( $bc_step['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php // ------------------------------------------------ Manage appointment ?>
<section class="bc-section bc-section--tight bc-section--white bc-manage">
	<div class="bc-container">
		<h2 class="bc-manage__title"><?php esc_html_e( 'Already have an appointment?', 'blinds-curtains' ); ?></h2>
		<a class="bc-manage__link" href="<?php echo esc_url( bc_appointment_url() ); ?>">
			<?php esc_html_e( 'Manage Existing Appointment', 'blinds-curtains' ); ?>
		</a>
	</div>
</section>

<?php // ------------------------------------------------ Lifetime guarantee ?>
<?php
get_template_part( 'template-parts/smart-motorised', null, array(
	'title'   => __( 'Built to Last a Lifetime', 'blinds-curtains' ),
	'lead'    => '',
	'text'    => __( 'Blinds to Go is proud to extend a lifetime warranty on the mechanism of most custom-made products. Ensuring our products are free from manufacturing defects in workmanship and components secures a lifetime of quality and reliability. For more information about our warranty, or in the event a blind fails to perform as expected, we will, at our discretion, repair or replace the product.', 'blinds-curtains' ),
	'image'   => 'consult-warranty.jpg',
	'buttons' => array(),
) );
?>

<?php // ------------------------------------------------------ Real projects ?>
<section class="bc-section bc-section--white bc-projects">
	<div class="bc-container">
		<div class="bc-section-head">
			<h2 class="bc-section-head__title"><?php esc_html_e( 'Real Projects by Real Designers', 'blinds-curtains' ); ?></h2>
		</div>

		<div class="bc-projects__grid">
			<?php foreach ( $bc_projects as $bc_col ) : ?>
				<div class="bc-projects__col">
					<?php foreach ( $bc_col as $bc_img ) : ?>
						<figure>
							<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_img ); ?>"
							     alt="" width="400" height="300" loading="lazy" decoding="async">
						</figure>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="bc-projects__note">
			<?php esc_html_e( 'See how our free in-home design service has helped a few familiar faces.', 'blinds-curtains' ); ?>
		</p>

		<div class="bc-projects__cta">
			<a class="bc-btn bc-btn--cta" href="<?php echo esc_url( bc_appointment_url() ); ?>">
				<?php echo esc_html( bc_cta_label() ); ?>
			</a>
		</div>
	</div>
</section>

<?php // -------------------------------------------------------- Social wall ?>
<section class="bc-section bc-section--white bc-social">
	<div class="bc-container">
		<h2 class="bc-social__title"><?php esc_html_e( '@Satayir', 'blinds-curtains' ); ?></h2>
		<p class="bc-social__lead">
			<?php esc_html_e( 'Inspiration straight from your homes. See it, share it, shop it.', 'blinds-curtains' ); ?>
			<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php esc_html_e( 'View More Costumer Photos', 'blinds-curtains' ); ?></a>
		</p>

		<ul class="bc-social__grid">
			<?php foreach ( $bc_social as $bc_img ) : ?>
				<li>
					<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_img ); ?>"
					     alt="" width="410" height="270" loading="lazy" decoding="async">
				</li>
			<?php endforeach; ?>
		</ul>

		<div class="bc-projects__cta">
			<a class="bc-btn bc-btn--cta" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
				<?php esc_html_e( 'Learn More..', 'blinds-curtains' ); ?>
			</a>
		</div>
	</div>
</section>

<?php
get_footer();
