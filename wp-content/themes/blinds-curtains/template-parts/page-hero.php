<?php
/**
 * Inner-page hero banner with a frosted card (Figma node 2:646 and siblings).
 *
 * Expects $args:
 *   image     string  filename in assets/img, or a full URL
 *   eyebrow   string  small blue line above the title
 *   title     string  leading words, rendered in brand orange
 *   title_alt string  trailing words, rendered in ink
 *   text      string  supporting sentence
 *   cta       string  button label (optional, defaults to the shared CTA label)
 *   cta_url   string  button destination (optional)
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bc_image     = isset( $args['image'] ) ? $args['image'] : 'image11.jpg';
$bc_eyebrow   = isset( $args['eyebrow'] ) ? $args['eyebrow'] : '';
$bc_title     = isset( $args['title'] ) ? $args['title'] : '';
$bc_title_alt = isset( $args['title_alt'] ) ? $args['title_alt'] : '';
$bc_text      = isset( $args['text'] ) ? $args['text'] : '';
$bc_cards     = isset( $args['cards'] ) && is_array( $args['cards'] ) ? $args['cards'] : array();
// Pass cta => false for the heroes that carry no button (e.g. Book A Free Visit).
$bc_cta       = array_key_exists( 'cta', (array) $args ) ? $args['cta'] : bc_cta_label();
$bc_cta_url   = isset( $args['cta_url'] ) ? $args['cta_url'] : bc_appointment_url();

$bc_src = ( 0 === strpos( $bc_image, 'http' ) ) ? $bc_image : BC_URI . '/assets/img/' . $bc_image;
?>
<section class="bc-page-hero<?php echo $bc_cards ? ' bc-page-hero--cards' : ''; ?>">
	<img class="bc-page-hero__image" src="<?php echo esc_url( $bc_src ); ?>"
	     alt="" width="1440" height="628" fetchpriority="high" decoding="async"
	     <?php bc_photo_attrs( $bc_image, '100vw' ); ?>>

	<div class="bc-page-hero__card">
		<?php if ( $bc_eyebrow ) : ?>
			<p class="bc-page-hero__eyebrow"><?php echo esc_html( $bc_eyebrow ); ?></p>
		<?php endif; ?>

		<h1 class="bc-page-hero__title">
			<span class="bc-page-hero__title-accent"><?php echo esc_html( $bc_title ); ?></span>
			<?php if ( $bc_title_alt ) : ?>
				<span><?php echo esc_html( $bc_title_alt ); ?></span>
			<?php endif; ?>
		</h1>

		<?php if ( $bc_text ) : ?>
			<p class="bc-page-hero__text"><?php echo esc_html( $bc_text ); ?></p>
		<?php endif; ?>

		<?php if ( $bc_cta ) : ?>
			<a class="bc-btn bc-btn--primary" href="<?php echo esc_url( $bc_cta_url ); ?>">
				<?php echo esc_html( $bc_cta ); ?>
			</a>
		<?php endif; ?>
	</div>

	<?php if ( $bc_cards ) : ?>
		<ul class="bc-page-hero__cards">
			<?php foreach ( $bc_cards as $bc_card ) : ?>
				<li>
					<span class="bc-page-hero__card-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24"><path d="M12 3 3 10h2v9h5v-5h4v5h5v-9h2l-9-7Zm0 6.2a1.8 1.8 0 1 1 0 3.6 1.8 1.8 0 0 1 0-3.6Z"/></svg>
					</span>
					<h2><?php echo esc_html( $bc_card['title'] ); ?></h2>
					<p><?php echo esc_html( $bc_card['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</section>
