<?php
/**
 * Product category archive — Figma node 2:528 (Blinds Category).
 *
 * Serves both the Blinds and Curtains ranges; headings come from the queried
 * taxonomy term so one template covers every category.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$bc_term  = is_tax() ? get_queried_object() : null;
$bc_label = $bc_term ? $bc_term->name : __( 'Blinds', 'blinds-curtains' );
$bc_intro = $bc_term && $bc_term->description
	? $bc_term->description
	: __( 'Our beautiful made to measure curtains are for every home and pocket too.', 'blinds-curtains' );

get_template_part( 'template-parts/page-hero', null, array(
	'image'     => 'image1.jpg',
	'eyebrow'   => sprintf(
		/* translators: %s: category name, lower-cased */
		__( 'Browse our different %s types', 'blinds-curtains' ),
		strtolower( $bc_label )
	),
	'title'     => $bc_label,
	'title_alt' => __( 'Dubai', 'blinds-curtains' ),
	'text'      => __( 'If you are not sure what will suit your window, our advisors can give you guidance at your home!', 'blinds-curtains' ),
) );
?>

<section class="bc-section bc-section--white bc-range">
	<div class="bc-container">

		<div class="bc-section-head">
			<h2 class="bc-section-head__title"><?php echo esc_html( $bc_label ); ?></h2>
			<p class="bc-section-head__lead"><?php echo esc_html( $bc_intro ); ?></p>
		</div>

		<?php // "How our service Work" bar with the angled orange tab (node 2:669). ?>
		<div class="bc-service-bar">
			<div class="bc-service-bar__tab">
				<span><?php esc_html_e( 'How our', 'blinds-curtains' ); ?></span>
				<span><?php esc_html_e( 'service Work', 'blinds-curtains' ); ?></span>
			</div>
			<ol class="bc-service-bar__steps">
				<?php foreach ( bc_service_steps() as $bc_i => $bc_step ) : ?>
					<li>
						<span class="bc-service-bar__num"><?php echo (int) ( $bc_i + 1 ); ?></span>
						<span class="bc-service-bar__text"><?php echo esc_html( $bc_step ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>

		<div class="bc-range__head">
			<h3 class="bc-range__title"><?php esc_html_e( 'Most Popular', 'blinds-curtains' ); ?></h3>
			<div class="bc-range__nav">
				<?php
				$bc_prev = get_previous_posts_link( '&larr;' );
				$bc_next = get_next_posts_link( '&rarr;' );
				?>
				<span class="bc-range__arrow<?php echo $bc_prev ? '' : ' is-disabled'; ?>">
					<?php echo $bc_prev ? wp_kses_post( $bc_prev ) : '<span aria-hidden="true">&larr;</span>'; ?>
				</span>
				<span class="bc-range__arrow<?php echo $bc_next ? '' : ' is-disabled'; ?>">
					<?php echo $bc_next ? wp_kses_post( $bc_next ) : '<span aria-hidden="true">&rarr;</span>'; ?>
				</span>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>
			<ul class="bc-products">
				<?php while ( have_posts() ) : the_post(); ?>
					<li class="bc-product-card">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'bc-card', array( 'loading' => 'lazy', 'decoding' => 'async', 'alt' => '' ) ); ?>
							<?php else : ?>
								<img src="<?php echo esc_url( BC_URI . '/assets/img/rectangle6.jpg' ); ?>"
								     alt="" width="308" height="326" loading="lazy" decoding="async">
							<?php endif; ?>
							<span class="bc-product-card__label"><?php the_title(); ?></span>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>

			<?php
			echo '<nav class="bc-pagination" aria-label="' . esc_attr__( 'Products', 'blinds-curtains' ) . '">';
			echo wp_kses_post( paginate_links( array(
				'mid_size'  => 1,
				'end_size'  => 1,
				'prev_next' => false,
				'type'      => 'plain',
			) ) );
			echo '</nav>';
			?>

		<?php else : ?>
			<p class="bc-range__empty"><?php esc_html_e( 'No products in this range yet.', 'blinds-curtains' ); ?></p>
		<?php endif; ?>

	</div>
</section>

<?php // Cream feature card (nodes 2:856 – 2:871). ?>
<section class="bc-section bc-section--white bc-why">
	<div class="bc-container">
		<h2 class="bc-why__title">
			<?php
			printf(
				/* translators: %1$s: category name, %2$s: highlighted trailing words */
				esc_html__( 'Why Our %1$s Service is Right %2$s', 'blinds-curtains' ),
				esc_html( $bc_label ),
				'<span>' . esc_html__( 'For You', 'blinds-curtains' ) . '</span>'
			);
			?>
		</h2>

		<ul class="bc-why__grid">
			<?php foreach ( bc_category_features() as $bc_feature ) : ?>
				<li class="bc-why__item">
					<span class="bc-why__tick" aria-hidden="true">
						<svg viewBox="0 0 24 24"><path d="M9.6 16.2 5.4 12l-1.4 1.4 5.6 5.6 12-12-1.4-1.4z"/></svg>
					</span>
					<div>
						<h3 class="bc-why__item-title"><?php echo esc_html( $bc_feature['title'] ); ?></h3>
						<p class="bc-why__item-text"><?php echo esc_html( $bc_feature['text'] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php
get_template_part( 'template-parts/inspiration' );

// "Electric Roman blinds" band sits between the inspiration grid and Need Help.
get_template_part( 'template-parts/smart-motorised', null, array(
	'title'   => __( 'Electric Roman blinds', 'blinds-curtains' ),
	'lead'    => '',
	'image'   => 'image4.jpg',
	'buttons' => array(
		__( 'Read All About Electric Blinds', 'blinds-curtains' ) => home_url( '/motorised/' ),
	),
) );

get_template_part( 'template-parts/need-help' );
get_template_part( 'template-parts/how-it-works' );
get_template_part( 'template-parts/testimonials' );
get_template_part( 'template-parts/appointment-form' );

get_footer();
