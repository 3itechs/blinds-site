<?php
/**
 * SEO admin: the settings screen, the per-page meta box and term fields.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Top-level SEO menu.
 */
function bc_seo_admin_menu() {
	add_menu_page(
		__( 'SEO Settings', 'blinds-curtains' ),
		__( 'SEO', 'blinds-curtains' ),
		'manage_options',
		'bc-seo',
		'bc_seo_settings_page',
		'dashicons-chart-line',
		58
	);
}
add_action( 'admin_menu', 'bc_seo_admin_menu' );

/**
 * Register the option and its sanitiser.
 */
function bc_seo_register_settings() {
	register_setting( 'bc_seo_group', BC_SEO_OPTION, array(
		'type'              => 'array',
		'sanitize_callback' => 'bc_seo_sanitize_settings',
		'default'           => array(),
	) );
}
add_action( 'admin_init', 'bc_seo_register_settings' );

/**
 * Sanitise the settings array field by field.
 *
 * @param mixed $input Raw submitted values.
 * @return array<string, mixed>
 */
function bc_seo_sanitize_settings( $input ) {
	$input = is_array( $input ) ? $input : array();
	$out   = array();

	$text = array( 'org_name', 'org_legal_name', 'org_type', 'phone', 'street', 'locality',
		'region', 'postal_code', 'country', 'price_range', 'opening_hours', 'twitter_handle',
		'google_verify', 'bing_verify', 'title_separator', 'home_title', 'latitude', 'longitude' );

	foreach ( $text as $key ) {
		$out[ $key ] = isset( $input[ $key ] ) ? sanitize_text_field( $input[ $key ] ) : '';
	}

	$out['email']            = isset( $input['email'] ) ? sanitize_email( $input['email'] ) : '';
	$out['home_description'] = isset( $input['home_description'] ) ? sanitize_textarea_field( $input['home_description'] ) : '';
	$out['social_profiles']  = isset( $input['social_profiles'] ) ? sanitize_textarea_field( $input['social_profiles'] ) : '';
	$out['logo_id']          = isset( $input['logo_id'] ) ? absint( $input['logo_id'] ) : 0;
	$out['default_og_id']    = isset( $input['default_og_id'] ) ? absint( $input['default_og_id'] ) : 0;

	foreach ( array( 'enable_schema', 'enable_og', 'enable_llms', 'allow_ai_bots' ) as $key ) {
		$out[ $key ] = empty( $input[ $key ] ) ? 0 : 1;
	}

	return $out;
}

/**
 * Render one settings row.
 *
 * @param string $key   Setting key.
 * @param string $label Field label.
 * @param string $type  text|textarea|checkbox|number.
 * @param string $help  Description shown under the field.
 */
function bc_seo_field( $key, $label, $type = 'text', $help = '' ) {
	$settings = bc_seo_settings();
	$value    = isset( $settings[ $key ] ) ? $settings[ $key ] : '';
	$name     = BC_SEO_OPTION . '[' . $key . ']';

	echo '<tr><th scope="row"><label for="bc-' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label></th><td>';

	if ( 'textarea' === $type ) {
		printf(
			'<textarea id="bc-%1$s" name="%2$s" rows="3" class="large-text">%3$s</textarea>',
			esc_attr( $key ),
			esc_attr( $name ),
			esc_textarea( $value )
		);
	} elseif ( 'checkbox' === $type ) {
		printf(
			'<label><input type="checkbox" id="bc-%1$s" name="%2$s" value="1" %3$s> %4$s</label>',
			esc_attr( $key ),
			esc_attr( $name ),
			checked( $value, 1, false ),
			esc_html__( 'Enabled', 'blinds-curtains' )
		);
	} else {
		printf(
			'<input type="text" id="bc-%1$s" name="%2$s" value="%3$s" class="regular-text">',
			esc_attr( $key ),
			esc_attr( $name ),
			esc_attr( $value )
		);
	}

	if ( $help ) {
		echo '<p class="description">' . esc_html( $help ) . '</p>';
	}

	echo '</td></tr>';
}

/**
 * The settings screen.
 */
function bc_seo_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'SEO Settings', 'blinds-curtains' ); ?></h1>
		<p><?php esc_html_e( 'These values feed the meta tags, Open Graph cards and the JSON-LD structured data on every page. Nothing here changes page content or layout.', 'blinds-curtains' ); ?></p>

		<form method="post" action="options.php">
			<?php settings_fields( 'bc_seo_group' ); ?>

			<h2><?php esc_html_e( 'Home page', 'blinds-curtains' ); ?></h2>
			<table class="form-table" role="presentation">
				<?php
				bc_seo_field( 'home_title', __( 'Home SEO title', 'blinds-curtains' ), 'text', __( 'Leave blank to use the site name. Aim for under 60 characters.', 'blinds-curtains' ) );
				bc_seo_field( 'home_description', __( 'Home meta description', 'blinds-curtains' ), 'textarea', __( 'Aim for 150-160 characters.', 'blinds-curtains' ) );
				bc_seo_field( 'title_separator', __( 'Title separator', 'blinds-curtains' ) );
				?>
			</table>

			<h2><?php esc_html_e( 'Business details (rich snippets)', 'blinds-curtains' ); ?></h2>
			<table class="form-table" role="presentation">
				<?php
				bc_seo_field( 'org_name', __( 'Business name', 'blinds-curtains' ) );
				bc_seo_field( 'org_legal_name', __( 'Legal name', 'blinds-curtains' ) );
				bc_seo_field( 'org_type', __( 'Schema business type', 'blinds-curtains' ), 'text', __( 'e.g. HomeAndConstructionBusiness, Store, LocalBusiness.', 'blinds-curtains' ) );
				bc_seo_field( 'phone', __( 'Phone', 'blinds-curtains' ) );
				bc_seo_field( 'email', __( 'Email', 'blinds-curtains' ) );
				bc_seo_field( 'street', __( 'Street address', 'blinds-curtains' ) );
				bc_seo_field( 'locality', __( 'City', 'blinds-curtains' ) );
				bc_seo_field( 'region', __( 'Region / Emirate', 'blinds-curtains' ) );
				bc_seo_field( 'postal_code', __( 'Postal code', 'blinds-curtains' ) );
				bc_seo_field( 'country', __( 'Country code', 'blinds-curtains' ), 'text', __( 'Two letters, e.g. AE.', 'blinds-curtains' ) );
				bc_seo_field( 'latitude', __( 'Latitude', 'blinds-curtains' ) );
				bc_seo_field( 'longitude', __( 'Longitude', 'blinds-curtains' ) );
				bc_seo_field( 'opening_hours', __( 'Opening hours', 'blinds-curtains' ), 'text', __( 'Schema format, e.g. Mo-Su 09:00-19:00.', 'blinds-curtains' ) );
				bc_seo_field( 'price_range', __( 'Price range', 'blinds-curtains' ) );
				?>
			</table>

			<h2><?php esc_html_e( 'Social', 'blinds-curtains' ); ?></h2>
			<table class="form-table" role="presentation">
				<?php
				bc_seo_field( 'twitter_handle', __( 'X / Twitter handle', 'blinds-curtains' ) );
				bc_seo_field( 'social_profiles', __( 'Profile URLs', 'blinds-curtains' ), 'textarea', __( 'One per line. Used for the sameAs property.', 'blinds-curtains' ) );
				bc_seo_field( 'logo_id', __( 'Logo attachment ID', 'blinds-curtains' ), 'text', __( 'Media library ID of the logo used in structured data.', 'blinds-curtains' ) );
				bc_seo_field( 'default_og_id', __( 'Default share image ID', 'blinds-curtains' ), 'text', __( 'Media library ID used when a page has no featured image.', 'blinds-curtains' ) );
				?>
			</table>

			<h2><?php esc_html_e( 'Verification', 'blinds-curtains' ); ?></h2>
			<table class="form-table" role="presentation">
				<?php
				bc_seo_field( 'google_verify', __( 'Google verification code', 'blinds-curtains' ) );
				bc_seo_field( 'bing_verify', __( 'Bing verification code', 'blinds-curtains' ) );
				?>
			</table>

			<h2><?php esc_html_e( 'Output', 'blinds-curtains' ); ?></h2>
			<table class="form-table" role="presentation">
				<?php
				bc_seo_field( 'enable_schema', __( 'JSON-LD structured data', 'blinds-curtains' ), 'checkbox' );
				bc_seo_field( 'enable_og', __( 'Open Graph and Twitter cards', 'blinds-curtains' ), 'checkbox' );
				bc_seo_field( 'enable_llms', __( 'Serve /llms.txt', 'blinds-curtains' ), 'checkbox', __( 'A plain-text site summary for AI assistants.', 'blinds-curtains' ) );
				bc_seo_field( 'allow_ai_bots', __( 'Allow AI crawlers', 'blinds-curtains' ), 'checkbox', __( 'Adds explicit Allow rules for GPTBot, ClaudeBot, PerplexityBot and others in robots.txt. Uncheck to block them.', 'blinds-curtains' ) );
				?>
			</table>

			<?php submit_button(); ?>
		</form>

		<h2><?php esc_html_e( 'Check your markup', 'blinds-curtains' ); ?></h2>
		<p>
			<a href="https://search.google.com/test/rich-results" target="_blank" rel="noopener"><?php esc_html_e( 'Google Rich Results Test', 'blinds-curtains' ); ?></a> &middot;
			<a href="https://validator.schema.org/" target="_blank" rel="noopener"><?php esc_html_e( 'Schema.org Validator', 'blinds-curtains' ); ?></a> &middot;
			<a href="<?php echo esc_url( home_url( '/wp-sitemap.xml' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Your sitemap', 'blinds-curtains' ); ?></a> &middot;
			<a href="<?php echo esc_url( home_url( '/llms.txt' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Your llms.txt', 'blinds-curtains' ); ?></a>
		</p>
	</div>
	<?php
}

/**
 * Per-object SEO meta box.
 */
function bc_seo_add_meta_box() {
	foreach ( bc_seo_post_types() as $type ) {
		add_meta_box(
			'bc_seo_box',
			__( 'SEO & Social', 'blinds-curtains' ),
			'bc_seo_render_meta_box',
			$type,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'bc_seo_add_meta_box' );

/**
 * Render the meta box.
 *
 * @param WP_Post $post Current post.
 */
function bc_seo_render_meta_box( $post ) {
	wp_nonce_field( 'bc_seo_meta', 'bc_seo_meta_nonce' );

	$get = function ( $key ) use ( $post ) {
		return get_post_meta( $post->ID, $key, true );
	};
	?>
	<style>
		.bc-seo-row { margin: 0 0 14px; }
		.bc-seo-row label { display:block; font-weight:600; margin-bottom:4px; }
		.bc-seo-row input[type=text], .bc-seo-row textarea { width:100%; }
		.bc-seo-count { float:right; font-weight:400; color:#666; }
		.bc-seo-count.over { color:#b32d2e; }
		.bc-seo-preview { background:#f6f7f7; border:1px solid #dcdcde; border-radius:4px; padding:12px 14px; margin-bottom:16px; }
		.bc-seo-preview .u { color:#006621; font-size:13px; }
		.bc-seo-preview .t { color:#1a0dab; font-size:18px; line-height:1.3; }
		.bc-seo-preview .d { color:#4d5156; font-size:13px; }
		.bc-seo-cols { display:flex; gap:20px; flex-wrap:wrap; }
		.bc-seo-cols > div { flex:1 1 260px; }
	</style>

	<div class="bc-seo-preview">
		<div class="u"><?php echo esc_html( get_permalink( $post->ID ) ); ?></div>
		<div class="t" id="bc-seo-preview-title"><?php echo esc_html( get_the_title( $post ) ); ?></div>
		<div class="d" id="bc-seo-preview-desc"></div>
	</div>

	<div class="bc-seo-row">
		<label for="bc_seo_title">
			<?php esc_html_e( 'SEO title', 'blinds-curtains' ); ?>
			<span class="bc-seo-count" data-for="bc_seo_title" data-max="60">0 / 60</span>
		</label>
		<input type="text" id="bc_seo_title" name="bc_seo_title" value="<?php echo esc_attr( $get( 'bc_seo_title' ) ); ?>"
		       placeholder="<?php echo esc_attr( get_the_title( $post ) ); ?>">
	</div>

	<div class="bc-seo-row">
		<label for="bc_seo_description">
			<?php esc_html_e( 'Meta description', 'blinds-curtains' ); ?>
			<span class="bc-seo-count" data-for="bc_seo_description" data-max="160">0 / 160</span>
		</label>
		<textarea id="bc_seo_description" name="bc_seo_description" rows="3"><?php echo esc_textarea( $get( 'bc_seo_description' ) ); ?></textarea>
	</div>

	<div class="bc-seo-cols">
		<div class="bc-seo-row">
			<label for="bc_seo_keywords"><?php esc_html_e( 'Focus keywords', 'blinds-curtains' ); ?></label>
			<input type="text" id="bc_seo_keywords" name="bc_seo_keywords" value="<?php echo esc_attr( $get( 'bc_seo_keywords' ) ); ?>">
		</div>
		<div class="bc-seo-row">
			<label for="bc_seo_canonical"><?php esc_html_e( 'Canonical URL', 'blinds-curtains' ); ?></label>
			<input type="text" id="bc_seo_canonical" name="bc_seo_canonical" value="<?php echo esc_attr( $get( 'bc_seo_canonical' ) ); ?>"
			       placeholder="<?php echo esc_attr( get_permalink( $post->ID ) ); ?>">
		</div>
	</div>

	<hr>

	<div class="bc-seo-cols">
		<div class="bc-seo-row">
			<label for="bc_seo_og_title"><?php esc_html_e( 'Social title', 'blinds-curtains' ); ?></label>
			<input type="text" id="bc_seo_og_title" name="bc_seo_og_title" value="<?php echo esc_attr( $get( 'bc_seo_og_title' ) ); ?>">
		</div>
		<div class="bc-seo-row">
			<label for="bc_seo_og_image"><?php esc_html_e( 'Social image (attachment ID)', 'blinds-curtains' ); ?></label>
			<input type="text" id="bc_seo_og_image" name="bc_seo_og_image" value="<?php echo esc_attr( $get( 'bc_seo_og_image' ) ); ?>"
			       placeholder="<?php esc_attr_e( 'Defaults to featured image', 'blinds-curtains' ); ?>">
		</div>
	</div>

	<div class="bc-seo-row">
		<label for="bc_seo_og_desc"><?php esc_html_e( 'Social description', 'blinds-curtains' ); ?></label>
		<textarea id="bc_seo_og_desc" name="bc_seo_og_desc" rows="2"><?php echo esc_textarea( $get( 'bc_seo_og_desc' ) ); ?></textarea>
	</div>

	<hr>

	<p>
		<label><input type="checkbox" name="bc_seo_noindex" value="1" <?php checked( $get( 'bc_seo_noindex' ), 1 ); ?>>
			<?php esc_html_e( 'Hide this page from search engines (noindex)', 'blinds-curtains' ); ?></label><br>
		<label><input type="checkbox" name="bc_seo_nofollow" value="1" <?php checked( $get( 'bc_seo_nofollow' ), 1 ); ?>>
			<?php esc_html_e( 'Do not follow links on this page (nofollow)', 'blinds-curtains' ); ?></label>
	</p>

	<script>
	(function () {
		var titleField = document.getElementById('bc_seo_title');
		var descField = document.getElementById('bc_seo_description');
		var pTitle = document.getElementById('bc-seo-preview-title');
		var pDesc = document.getElementById('bc-seo-preview-desc');

		function sync(field, counter) {
			var len = field.value.length;
			var max = parseInt(counter.dataset.max, 10);
			counter.textContent = len + ' / ' + max;
			counter.classList.toggle('over', len > max);
		}

		document.querySelectorAll('.bc-seo-count').forEach(function (counter) {
			var field = document.getElementById(counter.dataset.for);
			if (!field) { return; }
			sync(field, counter);
			field.addEventListener('input', function () {
				sync(field, counter);
				if (field === titleField) {
					pTitle.textContent = field.value || field.placeholder;
				}
				if (field === descField) {
					pDesc.textContent = field.value;
				}
			});
		});

		if (pDesc && descField) { pDesc.textContent = descField.value; }
	})();
	</script>
	<?php
}

/**
 * Save the meta box.
 *
 * @param int $post_id Post being saved.
 */
function bc_seo_save_meta( $post_id ) {
	if ( ! isset( $_POST['bc_seo_meta_nonce'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['bc_seo_meta_nonce'] ) ), 'bc_seo_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_fields = array( 'bc_seo_title', 'bc_seo_keywords', 'bc_seo_canonical', 'bc_seo_og_title', 'bc_seo_og_image' );
	foreach ( $text_fields as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
			if ( '' === $value ) {
				delete_post_meta( $post_id, $key );
			} else {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}

	foreach ( array( 'bc_seo_description', 'bc_seo_og_desc' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			$value = sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) );
			if ( '' === $value ) {
				delete_post_meta( $post_id, $key );
			} else {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}

	foreach ( array( 'bc_seo_noindex', 'bc_seo_nofollow' ) as $key ) {
		if ( empty( $_POST[ $key ] ) ) {
			delete_post_meta( $post_id, $key );
		} else {
			update_post_meta( $post_id, $key, 1 );
		}
	}
}
add_action( 'save_post', 'bc_seo_save_meta' );

/**
 * SEO fields on product category terms.
 *
 * @param WP_Term $term Term being edited.
 */
function bc_seo_term_fields( $term ) {
	$title = get_term_meta( $term->term_id, 'bc_seo_title', true );
	$desc  = get_term_meta( $term->term_id, 'bc_seo_description', true );
	wp_nonce_field( 'bc_seo_term', 'bc_seo_term_nonce' );
	?>
	<tr class="form-field">
		<th scope="row"><label for="bc_term_seo_title"><?php esc_html_e( 'SEO title', 'blinds-curtains' ); ?></label></th>
		<td><input type="text" id="bc_term_seo_title" name="bc_seo_title" value="<?php echo esc_attr( $title ); ?>" class="regular-text"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="bc_term_seo_desc"><?php esc_html_e( 'Meta description', 'blinds-curtains' ); ?></label></th>
		<td>
			<textarea id="bc_term_seo_desc" name="bc_seo_description" rows="3" class="large-text"><?php echo esc_textarea( $desc ); ?></textarea>
			<p class="description"><?php esc_html_e( 'Falls back to the category description when blank.', 'blinds-curtains' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'bc_product_cat_edit_form_fields', 'bc_seo_term_fields' );

/**
 * Save term SEO fields.
 *
 * @param int $term_id Term being saved.
 */
function bc_seo_save_term( $term_id ) {
	if ( ! isset( $_POST['bc_seo_term_nonce'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['bc_seo_term_nonce'] ) ), 'bc_seo_term' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_categories' ) ) {
		return;
	}

	if ( isset( $_POST['bc_seo_title'] ) ) {
		update_term_meta( $term_id, 'bc_seo_title', sanitize_text_field( wp_unslash( $_POST['bc_seo_title'] ) ) );
	}
	if ( isset( $_POST['bc_seo_description'] ) ) {
		update_term_meta( $term_id, 'bc_seo_description', sanitize_textarea_field( wp_unslash( $_POST['bc_seo_description'] ) ) );
	}
}
add_action( 'edited_bc_product_cat', 'bc_seo_save_term' );
