<?php
/**
 * Fallback template.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="bc-section bc-section--page">
	<div class="bc-container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'bc-entry' ); ?>>
					<h1 class="bc-section-head__title"><?php the_title(); ?></h1>
					<div class="bc-entry__content"><?php the_content(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found.', 'blinds-curtains' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
