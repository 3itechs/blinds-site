<?php
/**
 * "How it works" four-column band (Figma nodes 2:1490 – 2:1526).
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="bc-steps">
	<div class="bc-container">
		<div class="bc-section-head">
			<p class="bc-steps__eyebrow"><?php esc_html_e( 'HOW IT WORKS?', 'blinds-curtains' ); ?></p>
			<h2 class="bc-steps__title">
				<?php esc_html_e( 'Dressing your windows shouldn’t mean a dozen showroom trips.', 'blinds-curtains' ); ?>
			</h2>
		</div>
	</div>

	<ul class="bc-steps__grid">
		<?php foreach ( bc_home_steps() as $bc_i => $bc_step ) : ?>
			<li class="bc-step<?php echo ( 1 === $bc_i % 2 ) ? ' bc-step--filled' : ''; ?>">
				<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_step['icon'] ); ?>"
				     alt="" width="48" height="48" loading="lazy" decoding="async">
				<h3 class="bc-step__title"><?php echo esc_html( $bc_step['title'] ); ?></h3>
				<p class="bc-step__text"><?php echo esc_html( $bc_step['text'] ); ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
