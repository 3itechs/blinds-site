<?php
/**
 * Appointment request handling.
 *
 * Stores each submission as a private `bc_request` post so nothing is lost if
 * mail delivery fails, then emails the site admin.
 *
 * @package blinds-curtains
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the storage post type for submitted requests.
 */
function bc_register_request_type() {
	register_post_type( 'bc_request', array(
		'labels'          => array(
			'name'          => __( 'Appointment Requests', 'blinds-curtains' ),
			'singular_name' => __( 'Appointment Request', 'blinds-curtains' ),
		),
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'menu_icon'       => 'dashicons-calendar-alt',
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
		'supports'        => array( 'title' ),
	) );
}
add_action( 'init', 'bc_register_request_type' );

/**
 * Handle the appointment form POST.
 */
function bc_handle_appointment() {
	$redirect = isset( $_POST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ) : home_url( '/' );

	// Keep the redirect on this site regardless of what was posted.
	if ( ! wp_validate_redirect( $redirect, false ) ) {
		$redirect = home_url( '/' );
	}

	$fail = add_query_arg( 'appointment', 'error', $redirect ) . '#book-appointment';

	if ( ! isset( $_POST['bc_appointment_nonce'] )
		|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['bc_appointment_nonce'] ) ), 'bc_appointment' ) ) {
		wp_safe_redirect( $fail );
		exit;
	}

	// Honeypot: a filled value means a bot. Pretend success so it stops retrying.
	if ( ! empty( $_POST['bc_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'appointment', 'sent', $redirect ) . '#book-appointment' );
		exit;
	}

	$name  = isset( $_POST['bc_name'] ) ? sanitize_text_field( wp_unslash( $_POST['bc_name'] ) ) : '';
	$phone = isset( $_POST['bc_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['bc_phone'] ) ) : '';
	$email = isset( $_POST['bc_email'] ) ? sanitize_email( wp_unslash( $_POST['bc_email'] ) ) : '';

	if ( '' === $name || '' === $phone || ! is_email( $email ) ) {
		wp_safe_redirect( $fail );
		exit;
	}

	$fields = array(
		'name'     => $name,
		'phone'    => $phone,
		'email'    => $email,
		'whatsapp' => isset( $_POST['bc_whatsapp'] ) ? sanitize_text_field( wp_unslash( $_POST['bc_whatsapp'] ) ) : '',
		'windows'  => isset( $_POST['bc_windows'] ) ? absint( $_POST['bc_windows'] ) : 0,
		'date'     => isset( $_POST['bc_date'] ) ? sanitize_text_field( wp_unslash( $_POST['bc_date'] ) ) : '',
		'time'     => isset( $_POST['bc_time'] ) ? sanitize_text_field( wp_unslash( $_POST['bc_time'] ) ) : '',
		'source'   => isset( $_POST['bc_source'] ) ? sanitize_text_field( wp_unslash( $_POST['bc_source'] ) ) : '',
		'address'  => isset( $_POST['bc_address'] ) ? sanitize_text_field( wp_unslash( $_POST['bc_address'] ) ) : '',
		'query'    => isset( $_POST['bc_query'] ) ? sanitize_textarea_field( wp_unslash( $_POST['bc_query'] ) ) : '',
	);

	$needs = array();
	if ( isset( $_POST['bc_needs'] ) && is_array( $_POST['bc_needs'] ) ) {
		$needs = array_map( 'sanitize_key', wp_unslash( $_POST['bc_needs'] ) );
	}
	$fields['needs'] = implode( ', ', $needs );

	$post_id = wp_insert_post( array(
		'post_type'   => 'bc_request',
		'post_status' => 'private',
		/* translators: 1: customer name, 2: submission date */
		'post_title'  => sprintf( __( '%1$s — %2$s', 'blinds-curtains' ), $name, current_time( 'Y-m-d H:i' ) ),
	), true );

	if ( ! is_wp_error( $post_id ) ) {
		foreach ( $fields as $key => $value ) {
			update_post_meta( $post_id, "bc_{$key}", $value );
		}
	}

	$lines = array();
	foreach ( $fields as $key => $value ) {
		if ( '' !== $value && 0 !== $value ) {
			$lines[] = ucfirst( $key ) . ': ' . $value;
		}
	}

	wp_mail(
		get_option( 'admin_email' ),
		/* translators: %s: customer name */
		sprintf( __( 'New appointment request — %s', 'blinds-curtains' ), $name ),
		implode( "\n", $lines ),
		array( 'Reply-To: ' . $email )
	);

	wp_safe_redirect( add_query_arg( 'appointment', 'sent', $redirect ) . '#book-appointment' );
	exit;
}
add_action( 'admin_post_nopriv_bc_appointment', 'bc_handle_appointment' );
add_action( 'admin_post_bc_appointment', 'bc_handle_appointment' );
