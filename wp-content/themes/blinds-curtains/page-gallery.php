<?php
/**
 * Template Name: Gallery
 *
 * Figma node 2:2691.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/page-hero', null, array(
	'image' => 'gallery-hero.jpg',
	'title' => __( 'Gallery', 'blinds-curtains' ),
	'text'  => __( 'Window Treatment Inspiration Gallery', 'blinds-curtains' ),
	'cta'   => false,
) );

$bc_items   = bc_gallery_items();
$bc_filters = bc_gallery_filters();
?>

<section class="bc-section bc-section--white bc-gallery">
	<div class="bc-container">

		<div class="bc-gallery__filters" role="group" aria-label="<?php esc_attr_e( 'Filter gallery', 'blinds-curtains' ); ?>">
			<?php foreach ( $bc_filters as $bc_key => $bc_label ) : ?>
				<button type="button" class="bc-gallery__filter<?php echo 'all' === $bc_key ? ' is-active' : ''; ?>"
				        data-filter="<?php echo esc_attr( $bc_key ); ?>"
				        aria-pressed="<?php echo 'all' === $bc_key ? 'true' : 'false'; ?>">
					<?php echo esc_html( $bc_label ); ?>
				</button>
			<?php endforeach; ?>
		</div>

		<h2 class="bc-gallery__title">
			<?php esc_html_e( 'Take a Look at the Beautiful Window Coverings We’ve Installed Across Dubai', 'blinds-curtains' ); ?>
		</h2>

		<ul class="bc-gallery__grid">
			<?php foreach ( $bc_items as $bc_item ) : ?>
				<li class="bc-gallery__item" data-category="<?php echo esc_attr( $bc_item['cat'] ); ?>">
					<figure>
						<img src="<?php echo esc_url( bc_gallery_image_url( $bc_item ) ); ?>"
						     alt="<?php echo esc_attr( $bc_item['label'] ); ?>"
						     width="308" height="326" loading="lazy" decoding="async">
						<figcaption><?php echo esc_html( $bc_item['label'] ); ?></figcaption>
					</figure>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php // Static pager: the grid is a fixed marketing set, not a query. ?>
		<nav class="bc-pagination" aria-label="<?php esc_attr_e( 'Gallery pages', 'blinds-curtains' ); ?>">
			<span class="page-numbers current" aria-current="page">1</span>
			<a class="page-numbers" href="#">2</a>
			<a class="page-numbers" href="#">3</a>
			<span class="page-numbers dots">&hellip;</span>
			<a class="page-numbers" href="#">6</a>
		</nav>

	</div>
</section>

<?php
get_template_part( 'template-parts/smart-motorised' );
get_template_part( 'template-parts/automation-benefits' );
get_template_part( 'template-parts/guarantee' );
get_template_part( 'template-parts/testimonials' );

get_footer();
