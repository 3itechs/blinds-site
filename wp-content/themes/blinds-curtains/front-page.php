<?php
/**
 * Home page — Figma node 2:1001.
 *
 * Sections, top to bottom: hero slider, category cards, Go Automatic,
 * Why You Should Trust Us, inspiration masonry, Need Help, How It Works,
 * testimonials, appointment form.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$bc_book = esc_url( bc_appointment_url() );
?>

<?php // ------------------------------------------------------------- Hero ?>
<section class="bc-hero" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Featured', 'blinds-curtains' ); ?>">
	<div class="bc-hero__track">
		<?php foreach ( bc_home_slides() as $bc_i => $bc_slide ) : ?>
			<div class="bc-hero__slide<?php echo 0 === $bc_i ? ' is-active' : ''; ?>"
			     role="group" aria-roledescription="slide"
			     aria-label="<?php echo esc_attr( sprintf( __( 'Slide %1$d of %2$d', 'blinds-curtains' ), $bc_i + 1, count( bc_home_slides() ) ) ); ?>">
				<img class="bc-hero__image"
				     src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_slide['image'] ); ?>"
				     alt="" width="1440" height="628"
				     <?php
						// Every slide loads eagerly. A lazy image inside a
						// visibility:hidden slide is never fetched, so the
						// banner went blank the moment the slider advanced.
						echo 0 === $bc_i ? 'fetchpriority="high"' : 'loading="eager" fetchpriority="low"';
					?> decoding="async"
				     <?php bc_photo_attrs( $bc_slide['image'], '100vw' ); ?>>

				<div class="bc-hero__card">
					<h1 class="bc-hero__title">
						<?php echo esc_html( $bc_slide['title'] ); ?>
						<span class="bc-hero__title-accent"><?php echo esc_html( $bc_slide['highlight'] ); ?></span>
					</h1>
					<p class="bc-hero__text"><?php echo esc_html( $bc_slide['text'] ); ?></p>
					<a class="bc-btn bc-btn--primary bc-hero__cta" href="<?php echo $bc_book; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above ?>">
						<?php echo esc_html( bc_cta_label() ); ?>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="bc-hero__dots" role="tablist" aria-label="<?php esc_attr_e( 'Choose slide', 'blinds-curtains' ); ?>">
		<?php foreach ( bc_home_slides() as $bc_i => $bc_slide ) : ?>
			<button type="button" class="bc-hero__dot<?php echo 0 === $bc_i ? ' is-active' : ''; ?>"
			        role="tab" aria-selected="<?php echo 0 === $bc_i ? 'true' : 'false'; ?>"
			        data-slide="<?php echo esc_attr( $bc_i ); ?>">
				<span class="screen-reader-text">
					<?php echo esc_html( sprintf( __( 'Go to slide %d', 'blinds-curtains' ), $bc_i + 1 ) ); ?>
				</span>
			</button>
		<?php endforeach; ?>
	</div>
</section>

<?php // -------------------------------------------------- Made to Measure ?>
<section class="bc-section bc-section--white bc-categories">
	<div class="bc-container">

		<div class="bc-section-head">
			<h2 class="bc-section-head__title"><?php esc_html_e( 'Made to Measure Window Dressing', 'blinds-curtains' ); ?></h2>
			<p class="bc-section-head__lead">
				<?php esc_html_e( 'Browse our huge range of bespoke blinds in Dubai with modern and classic designs.', 'blinds-curtains' ); ?>
			</p>
		</div>

		<ul class="bc-categories__grid">
			<?php foreach ( bc_home_categories() as $bc_cat ) : ?>
				<li class="bc-category">
					<a class="bc-category__link" href="<?php echo esc_url( home_url( $bc_cat['url'] ) ); ?>">
						<span class="bc-category__media">
							<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_cat['image'] ); ?>"
							     alt="" width="410" height="453" loading="lazy" decoding="async">
							<span class="bc-category__pill">
								<span class="bc-category__more"><?php esc_html_e( 'More Details', 'blinds-curtains' ); ?></span>
								<img class="bc-category__arrow"
								     src="<?php echo esc_url( BC_URI . '/assets/img/vuesax-linear-arrow-circle-right.svg' ); ?>"
								     alt="" width="32" height="32">
							</span>
						</span>
						<span class="bc-category__label"><?php echo esc_html( $bc_cat['label'] ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>
</section>

<?php // ----------------------------------------------------- Go Automatic ?>
<section class="bc-automatic">
	<div class="bc-automatic__media">
		<img src="<?php echo esc_url( BC_URI . '/assets/img/image14.jpg' ); ?>"
		     alt="<?php esc_attr_e( 'Consultant taking a call at a design desk', 'blinds-curtains' ); ?>"
		     width="712" height="697" loading="lazy" decoding="async">
	</div>

	<div class="bc-automatic__body">
		<h2 class="bc-automatic__title"><?php esc_html_e( 'Go Automatic!', 'blinds-curtains' ); ?></h2>
		<p class="bc-automatic__text">
			<?php esc_html_e( 'Motorised Blinds can be integrated with your smart home hub. Operate your blinds using the same button, touchscreen and voice commands you use to control your lights, heating and home media system. This is next-level domestic convenience!', 'blinds-curtains' ); ?>
		</p>

		<ul class="bc-automatic__features">
			<?php foreach ( bc_home_automation_features() as $bc_feature ) : ?>
				<li>
					<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_feature['icon'] ); ?>"
					     alt="" width="40" height="40" loading="lazy" decoding="async">
					<span><?php echo esc_html( $bc_feature['label'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>

		<a class="bc-btn bc-btn--primary bc-automatic__cta" href="<?php echo esc_url( home_url( '/motorised/' ) ); ?>">
			<?php esc_html_e( 'Shop Now', 'blinds-curtains' ); ?>
		</a>
	</div>
</section>

<?php // ------------------------------------------------------------ Trust ?>
<section class="bc-trust">
	<img class="bc-trust__bg" src="<?php echo esc_url( BC_URI . '/assets/img/image8.jpg' ); ?>"
	     alt="" width="1440" height="1164" loading="lazy" decoding="async" aria-hidden="true">

	<div class="bc-container bc-trust__inner">
		<h2 class="bc-trust__title"><?php esc_html_e( 'Why You Should Trust Us', 'blinds-curtains' ); ?></h2>

		<ul class="bc-trust__grid">
			<?php foreach ( bc_home_trust_cards() as $bc_card ) : ?>
				<li class="bc-trust-card">
					<img class="bc-trust-card__image"
					     src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_card['image'] ); ?>"
					     alt="" width="418" height="221" loading="lazy" decoding="async">
					<div class="bc-trust-card__body">
						<h3 class="bc-trust-card__title"><?php echo esc_html( $bc_card['title'] ); ?></h3>
						<p class="bc-trust-card__text"><?php echo esc_html( $bc_card['text'] ); ?></p>
						<div class="bc-trust-card__actions">
							<a class="bc-btn bc-btn--sm-solid" href="<?php echo $bc_book; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above ?>">
								<?php echo esc_html( bc_cta_label() ); ?>
							</a>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php
get_template_part( 'template-parts/inspiration' );
get_template_part( 'template-parts/need-help' );
get_template_part( 'template-parts/how-it-works' );
get_template_part( 'template-parts/testimonials' );
get_template_part( 'template-parts/appointment-form' );

get_footer();
