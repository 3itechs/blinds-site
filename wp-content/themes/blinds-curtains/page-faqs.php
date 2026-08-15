<?php
/**
 * Template Name: FAQs
 *
 * Figma node 2:1981.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'image' => 'image12.jpg',
	'title' => __( 'How Can I Help You?', 'blinds-curtains' ),
	'cta'   => false,
	'cards' => array(
		array(
			'title' => __( 'Measuring & Fitting', 'blinds-curtains' ),
			'text'  => __( 'Both are included in every quote. We handle the job from first measurement to final adjustment.', 'blinds-curtains' ),
		),
		array(
			'title' => __( 'Fabrics & Finishes', 'blinds-curtains' ),
			'text'  => __( 'Hundreds of fabrics, from blackout weaves to fine sheers, brought to your home to see in your own light.', 'blinds-curtains' ),
		),
		array(
			'title' => __( 'Warranty & Aftercare', 'blinds-curtains' ),
			'text'  => __( 'Every installation is guaranteed. If something needs adjusting later, we come back and put it right.', 'blinds-curtains' ),
		),
	),
) );
?>

<section class="bc-section bc-section--page">
	<div class="bc-container">
		<div class="bc-intro-card">
			<figure class="bc-intro-card__media">
				<img src="<?php echo esc_url( BC_URI . '/assets/img/image14.jpg' ); ?>"
				     alt="" width="600" height="430" loading="lazy" decoding="async">
			</figure>
			<div class="bc-intro-card__body">
				<h2><?php esc_html_e( 'Everything worth knowing before you choose your window coverings.', 'blinds-curtains' ); ?></h2>
				<p>
					<?php esc_html_e( 'Most of what people ask us comes down to three things: how well a fabric holds back the Dubai sun, how easy it is to keep clean, and how long it will last once it is up. The answers below cover the questions we hear most often. If yours is not here, message the team and an advisor will get back to you.', 'blinds-curtains' ); ?>
				</p>
				<a class="bc-intro-card__link" href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"
				   aria-label="<?php esc_attr_e( 'Read more about us', 'blinds-curtains' ); ?>">
					<svg viewBox="0 0 40 12" aria-hidden="true"><path d="M0 6h36M31 1l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/faq', null, array( 'bg' => 'cream' ) );
get_template_part( 'template-parts/testimonials' );

get_footer();
