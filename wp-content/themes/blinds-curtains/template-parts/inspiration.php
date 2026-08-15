<?php
/**
 * "Blinds and curtains Inspiration and Idea" masonry.
 *
 * Shared by Home, the product archives and the category pages.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="bc-section bc-section--white bc-inspiration">
	<div class="bc-container">

		<div class="bc-section-head">
			<h2 class="bc-section-head__title"><?php esc_html_e( 'Blinds and curtains Inspiration and Idea', 'blinds-curtains' ); ?></h2>
			<p class="bc-section-head__lead">
				<?php esc_html_e( "We've plenty of fabulous ideas to get your next project started", 'blinds-curtains' ); ?>
			</p>
		</div>

		<div class="bc-inspiration__grid">
			<?php foreach ( bc_home_inspiration_columns() as $bc_column ) : ?>
				<div class="bc-inspiration__col">
					<?php foreach ( $bc_column as $bc_tile ) : ?>
						<figure class="bc-inspiration__tile" style="--tile-h: <?php echo (int) $bc_tile['h']; ?>px;">
							<img src="<?php echo esc_url( BC_URI . '/assets/img/' . $bc_tile['image'] ); ?>"
							     alt="" width="315" height="<?php echo (int) $bc_tile['h']; ?>"
							     loading="lazy" decoding="async">
						</figure>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="bc-inspiration__more">
			<a class="bc-btn bc-btn--primary" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>">
				<?php esc_html_e( 'Learn More..', 'blinds-curtains' ); ?>
			</a>
		</div>

	</div>
</section>
