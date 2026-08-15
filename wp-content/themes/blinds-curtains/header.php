<?php
/**
 * Site header: utility bar, logo, primary navigation, appointment CTA.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#bc-main"><?php esc_html_e( 'Skip to content', 'blinds-curtains' ); ?></a>

<header class="bc-header">

	<div class="bc-topbar">
		<ul class="bc-topbar__list">
			<?php foreach ( bc_topbar_promises() as $promise ) : ?>
				<li class="bc-topbar__item">
					<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $promise['icon'] ); ?>"
					     alt="" width="32" height="32" loading="eager" decoding="async">
					<span><?php echo esc_html( $promise['label'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="bc-navbar">
		<?php bc_logo(); ?>

		<button class="bc-nav-toggle" type="button"
		        aria-expanded="false" aria-controls="bc-primary-nav"
		        aria-label="<?php esc_attr_e( 'Toggle navigation', 'blinds-curtains' ); ?>">
			<span></span>
		</button>

		<nav class="bc-nav" id="bc-primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'blinds-curtains' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'bc-nav__list',
				'depth'          => 1,
				'fallback_cb'    => 'bc_primary_menu_fallback',
			) );
			?>
		</nav>

		<a class="bc-btn bc-btn--cta bc-header__cta" href="<?php echo esc_url( bc_appointment_url() ); ?>">
			<?php echo esc_html( bc_cta_label() ); ?>
		</a>
	</div>

</header>

<main id="bc-main">
