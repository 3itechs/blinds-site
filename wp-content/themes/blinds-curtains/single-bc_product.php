<?php
/**
 * Product detail — Figma node 2:3012.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$bc_id       = get_the_ID();
	$bc_price    = get_post_meta( $bc_id, 'bc_price', true ) ?: '530';
	$bc_size     = get_post_meta( $bc_id, 'bc_size', true ) ?: '3m X 1.5m';
	$bc_currency = get_post_meta( $bc_id, 'bc_currency', true ) ?: 'AED';
	$bc_chips    = array_filter( array_map( 'trim', explode( ',', get_post_meta( $bc_id, 'bc_features', true ) ?: 'Light Blockage, Privacy, Energy-Efficient, Huge Choices' ) ) );
	$bc_gallery  = bc_product_gallery( $bc_id );
	$bc_whatsapp = preg_replace( '/\D/', '', bc_contact_details()['whatsapp'] );
	?>

	<section class="bc-product">
		<div class="bc-container">
			<div class="bc-product__layout">

				<?php // ------------------------------------------------ Gallery ?>
				<div class="bc-product__gallery">
					<figure class="bc-product__stage">
						<?php if ( $bc_gallery ) : ?>
							<img id="bc-product-main" src="<?php echo esc_url( $bc_gallery[0]['full'] ); ?>"
							     alt="<?php the_title_attribute(); ?>" width="620" height="620"
							     fetchpriority="high" decoding="async">
						<?php else : ?>
							<img id="bc-product-main" src="<?php echo esc_url( BC_URI . '/assets/img/rectangle5.jpg' ); ?>"
							     alt="<?php the_title_attribute(); ?>" width="620" height="620" decoding="async">
						<?php endif; ?>
					</figure>

					<?php if ( count( $bc_gallery ) > 1 ) : ?>
						<ul class="bc-product__thumbs">
							<?php foreach ( $bc_gallery as $bc_i => $bc_shot ) : ?>
								<li>
									<button type="button" class="bc-product__thumb<?php echo 0 === $bc_i ? ' is-active' : ''; ?>"
									        data-full="<?php echo esc_url( $bc_shot['full'] ); ?>">
										<img src="<?php echo esc_url( $bc_shot['thumb'] ); ?>" alt="" width="114" height="100"
										     loading="lazy" decoding="async">
										<span class="screen-reader-text">
											<?php echo esc_html( sprintf( __( 'View image %d', 'blinds-curtains' ), $bc_i + 1 ) ); ?>
										</span>
									</button>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>

				<?php // --------------------------------------------------- Info ?>
				<div class="bc-product__info">
					<h1 class="bc-product__title"><?php the_title(); ?></h1>

					<?php if ( $bc_chips ) : ?>
						<ul class="bc-product__chips">
							<?php foreach ( $bc_chips as $bc_chip ) : ?>
								<li><?php echo esc_html( $bc_chip ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<p class="bc-product__from"><?php esc_html_e( 'Starting from', 'blinds-curtains' ); ?></p>
					<p class="bc-product__price">
						<span><?php echo esc_html( $bc_currency . ' ' . $bc_price ); ?></span>
						<small>(<?php echo esc_html( $bc_size ); ?>)</small>
					</p>

					<div class="bc-product__desc"><?php the_content(); ?></div>

					<div class="bc-product__actions">
						<a class="bc-btn bc-product__book" href="<?php echo esc_url( bc_appointment_url() ); ?>">
							<?php echo esc_html( bc_cta_label() ); ?>
						</a>
						<a class="bc-btn bc-product__whatsapp" target="_blank" rel="noopener"
						   href="https://wa.me/<?php echo esc_attr( $bc_whatsapp ); ?>">
							<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15l-1.3 4.8 4.9-1.3A10 10 0 1 0 12 2Zm5.8 14.2c-.2.7-1.2 1.3-1.9 1.4-.5.1-1.1.2-3.2-.7-2.7-1.1-4.4-3.9-4.5-4-.1-.2-1.1-1.4-1.1-2.7s.7-1.9 1-2.2c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.4 0 .5l-.3.5-.3.3c-.1.1-.3.3-.1.6.2.3.7 1.2 1.6 2 1.1.9 1.9 1.2 2.2 1.3.2.1.4.1.6-.1l.8-1c.2-.2.3-.2.6-.1l2 .9c.2.1.4.2.4.3.1.2.1.7-.1 1.3Z"/></svg>
							<span><?php esc_html_e( 'WHATSAPP US', 'blinds-curtains' ); ?></span>
						</a>
					</div>

					<ul class="bc-product__assurances">
						<li>
							<span class="bc-product__assurance-icon">
								<svg viewBox="0 0 24 24"><path d="M7 4h10l1 3H6l1-3Zm-2 5h14l-1 11H6L5 9Zm7 2v3H9v2h3v3h2v-3h3v-2h-3v-3h-2Z"/></svg>
							</span>
							<span><?php esc_html_e( 'Free Home Consultation', 'blinds-curtains' ); ?></span>
						</li>
						<li>
							<span class="bc-product__assurance-icon">
								<svg viewBox="0 0 24 24"><path d="M3 6h18v4H3V6Zm0 6h18v6H3v-6Zm2 2v2h6v-2H5Z"/></svg>
							</span>
							<span><?php esc_html_e( 'Split your payments', 'blinds-curtains' ); ?></span>
							<span class="bc-product__pay">
								<em class="bc-product__pay--tabby">tabby</em>
								<em class="bc-product__pay--tamara">tamara</em>
							</span>
						</li>
						<li>
							<span class="bc-product__assurance-icon">
								<svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5 3.4 9.7 8 11 4.6-1.3 8-6 8-11V5l-8-3Zm-1 14-4-4 1.4-1.4L11 13.2l4.6-4.6L17 10l-6 6Z"/></svg>
							</span>
							<span><?php esc_html_e( 'Professional installation', 'blinds-curtains' ); ?></span>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</section>

	<?php // ------------------------------------------- Best experience band ?>
	<section class="bc-experience">
		<div class="bc-container">
			<div class="bc-experience__layout">
				<div class="bc-experience__body">
					<h2 class="bc-experience__title"><?php esc_html_e( 'We Provide You The Best Experience', 'blinds-curtains' ); ?></h2>
					<p class="bc-experience__text">
						<?php esc_html_e( 'You don’t have to worry about the result because all of these interiors are made by people who are professionals in their fields with an elegant and lucurious style and with premium quality materials', 'blinds-curtains' ); ?>
					</p>
					<a class="bc-btn bc-btn--cta" href="<?php echo esc_url( bc_appointment_url() ); ?>">
						<?php echo esc_html( bc_cta_label() ); ?>
					</a>
				</div>
				<figure class="bc-experience__media">
					<img src="<?php echo esc_url( BC_URI . '/assets/img/image2.jpg' ); ?>"
					     alt="" width="620" height="430" loading="lazy" decoding="async">
				</figure>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/faq' ); ?>

	<?php // ------------------------------------------------- Related products ?>
	<?php
	$bc_terms   = wp_get_post_terms( $bc_id, 'bc_product_cat', array( 'fields' => 'ids' ) );
	$bc_related = new WP_Query( array(
		'post_type'           => 'bc_product',
		'posts_per_page'      => 3,
		'post__not_in'        => array( $bc_id ),
		'ignore_sticky_posts' => true,
		'orderby'             => 'rand',
		'tax_query'           => $bc_terms ? array( array(
			'taxonomy' => 'bc_product_cat',
			'field'    => 'term_id',
			'terms'    => $bc_terms,
		) ) : array(),
	) );

	if ( $bc_related->have_posts() ) :
		?>
		<section class="bc-section bc-section--page bc-related">
			<div class="bc-container">
				<h2 class="bc-related__title"><?php esc_html_e( 'Related Product', 'blinds-curtains' ); ?></h2>

				<ul class="bc-related__grid">
					<?php while ( $bc_related->have_posts() ) : $bc_related->the_post(); ?>
						<li class="bc-related-card">
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'bc-card', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
								<?php endif; ?>
								<h3 class="bc-related-card__title"><?php the_title(); ?></h3>
								<p class="bc-related-card__text">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
								</p>
								<span class="bc-related-card__cta"><?php esc_html_e( 'Learn More', 'blinds-curtains' ); ?></span>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	endif;

	// The design closes on the testimonials — booking happens via the two
	// buttons beside the price, not a form at the foot of the page.
	get_template_part( 'template-parts/testimonials' );

endwhile;

get_footer();
