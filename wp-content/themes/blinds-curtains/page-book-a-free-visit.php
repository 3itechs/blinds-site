<?php
/**
 * Template Name: Book A Free Visit
 *
 * Figma node 2:1527.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'image' => 'visit-hero.jpg',
	'title' => __( 'Book A Free Visit', 'blinds-curtains' ),
	'text'  => __( 'Get some rough window measurements and call us', 'blinds-curtains' ),
	'cta'   => false,
) );

$bc_contact = bc_contact_details();
?>

<section class="bc-section bc-section--white bc-tellus">
	<div class="bc-container">

		<div class="bc-section-head">
			<h2 class="bc-section-head__title"><?php esc_html_e( 'Tell Us More', 'blinds-curtains' ); ?></h2>
			<p class="bc-section-head__lead">
				<?php esc_html_e( 'The most trusted window treatment company in Dubai with a decade of experience and 100s of positive reviews.', 'blinds-curtains' ); ?>
			</p>
		</div>

		<div class="bc-tellus__panel">
			<h3 class="bc-tellus__heading"><?php esc_html_e( 'Contact Info', 'blinds-curtains' ); ?></h3>

			<div class="bc-tellus__layout">
				<div class="bc-tellus__form">
					<?php get_template_part( 'template-parts/appointment-form', null, array( 'bare' => true ) ); ?>
				</div>

				<aside class="bc-tellus__aside">
					<h3><?php esc_html_e( 'Tell Me More', 'blinds-curtains' ); ?></h3>
					<p class="bc-tellus__blurb">
						<?php esc_html_e( 'The most trusted window treatment company in Dubai with a decade of experience and 100s of positive reviews.', 'blinds-curtains' ); ?>
					</p>

					<h4><?php esc_html_e( 'Contact Info:', 'blinds-curtains' ); ?></h4>
					<ul class="bc-tellus__list">
						<li>
							<span class="bc-tellus__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5Z"/></svg>
							</span>
							<span><?php echo esc_html( bc_business_address() ); ?></span>
						</li>
						<li>
							<span class="bc-tellus__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24"><path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.2.4 2.4.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1l-2.3 2.2Z"/></svg>
							</span>
							<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $bc_contact['phone'] ) ); ?>"><?php echo esc_html( $bc_contact['phone'] ); ?></a>
						</li>
						<li>
							<span class="bc-tellus__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24"><path d="M7 2v2H5a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2V2h-2v2H9V2H7ZM5 9h14v10H5V9Z"/></svg>
							</span>
							<span><?php echo esc_html( get_theme_mod( 'bc_hours', __( '9:00am - 7:00pm 7 days a week', 'blinds-curtains' ) ) ); ?></span>
						</li>
						<li>
							<span class="bc-tellus__icon" aria-hidden="true">
								<svg viewBox="0 0 24 24"><path d="M3 5h18v14H3V5Zm2 2v.4l7 4.4 7-4.4V7H5Zm0 3v7h14v-7l-7 4.3L5 10Z"/></svg>
							</span>
							<a href="mailto:<?php echo esc_attr( $bc_contact['email'] ); ?>"><?php echo esc_html( $bc_contact['email'] ); ?></a>
						</li>
					</ul>
				</aside>
			</div>
		</div>

	</div>
</section>

<?php
get_footer();
