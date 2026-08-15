<?php
/**
 * Site footer: brand column, link columns, contact pill row, legal bar.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_contact = bc_contact_details();
?>
</main><!-- #bc-main -->

<footer class="bc-footer">

	<div class="bc-container">
		<div class="bc-footer__main">

			<div class="bc-footer__cols">

				<div class="bc-footer__col bc-footer__col--brand">
					<?php bc_logo(); ?>
					<p class="bc-footer__about"><?php echo esc_html( bc_footer_about() ); ?></p>
				</div>

				<div class="bc-footer__col">
					<h2 class="bc-footer__heading"><?php esc_html_e( 'Our Product', 'blinds-curtains' ); ?></h2>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'bc-footer__links',
						'depth'          => 1,
						'fallback_cb'    => 'bc_footer_products_fallback',
					) );
					?>
				</div>

				<div class="bc-footer__col">
					<h2 class="bc-footer__heading"><?php esc_html_e( 'Our pages', 'blinds-curtains' ); ?></h2>
					<ul class="bc-footer__links">
						<li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'blinds-curtains' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/faqs/' ) ); ?>"><?php esc_html_e( "FAQ's", 'blinds-curtains' ); ?></a></li>
					</ul>
				</div>

			</div>

			<div class="bc-footer__contact">
				<span class="bc-footer__need-help"><?php esc_html_e( 'Need Help?', 'blinds-curtains' ); ?></span>

				<a class="bc-footer__contact-item" href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $bc_contact['phone'] ) ); ?>">
					<span class="bc-icon-ring"><img src="<?php echo esc_url( BC_URI . '/assets/img/black.svg' ); ?>" alt="" width="14" height="14"></span>
					<span><?php echo esc_html( $bc_contact['phone'] ); ?></span>
				</a>

				<a class="bc-footer__contact-item" href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D/', '', $bc_contact['whatsapp'] ) ); ?>" target="_blank" rel="noopener">
					<span class="bc-icon-ring"><img src="<?php echo esc_url( BC_URI . '/assets/img/black1.svg' ); ?>" alt="" width="14" height="14"></span>
					<span><?php echo esc_html( $bc_contact['whatsapp'] ); ?></span>
				</a>

				<a class="bc-footer__contact-item" href="mailto:<?php echo esc_attr( $bc_contact['email'] ); ?>">
					<span class="bc-icon-ring"><img src="<?php echo esc_url( BC_URI . '/assets/img/black2.svg' ); ?>" alt="" width="14" height="14"></span>
					<span><?php echo esc_html( $bc_contact['email'] ); ?></span>
				</a>
			</div>

		</div>
	</div>

	<div class="bc-footer__bar">
		<div class="bc-container">
			<div class="bc-footer__bar-inner">

				<nav class="bc-footer__legal" aria-label="<?php esc_attr_e( 'Legal', 'blinds-curtains' ); ?>">
					<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy policy', 'blinds-curtains' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/terms-and-condition/' ) ); ?>"><?php esc_html_e( 'Terms and Condition', 'blinds-curtains' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/returns-and-refund/' ) ); ?>"><?php esc_html_e( 'Returne & Refund', 'blinds-curtains' ); ?></a>
				</nav>

				<div class="bc-footer__social">
					<?php foreach ( bc_social_links() as $social ) : ?>
						<a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener"
						   aria-label="<?php echo esc_attr( $social['label'] ); ?>">
							<?php echo bc_social_icon( $social['id'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG ?>
						</a>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
