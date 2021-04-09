<?php
/**
 * Helper functions for the plugin
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Send a single email (no trigger required)
 *
 * @param WP_Post $email_post Email post object
 * @param WP_User $user       User object
 */
function pce_send_email( $email_post, $user ) {
  $to      = $user->user_email;
  $subject = get_the_title( $email_post );
  $body    = pce_process_placeholders( get_the_content( null, false, $email_post ), $user );
  $headers = array( 'Content-Type: text/html; charset=UTF-8' );
  return wp_mail( $to, $subject, $body, $headers );
}

/**
 * Send emails for certain trigger
 *
 * @param int/string  $trigger Trigger (tag) ID/slug
 * @param int/WP_User $user    User ID or User Object
 */
function pce_send_emails( $trigger = '', $user = 0 ) {
  if ( ! term_exists( $trigger, 'trigger' ) ) {
    return new WP_Error( 'pie-custom-emails', 'No trigger found with ID/slug: ' . $trigger );
  }
  if ( ! is_a( $user, 'WP_User' ) ) {
    $user = get_user_by( 'id', $user );
  }
  if ( ! $user ) {
    return new WP_Error( 'pie-custom-emails', 'No user found' );
  }
  // Get an array of all emails with set trigger
	$emails = pce_get_emails( $trigger );
	if ( empty( $emails ) ) {
		return new WP_Error( 'pie-custom-emails', 'No emails found for trigger: ' . $trigger );;
	}
  // loop through emails (post objects) and send
  foreach ( $emails as $email_post ) {
    pce_send_email( $email_post, $user );
  }
}

/**
 * Retrieve email posts by trigger (tag)
 *
 * @param int/string $trigger Trigger (tag) ID/slug
 */
function pce_get_emails( $trigger = '' ) {
  $field = is_int( $trigger ) ? 'term_id' : 'slug';
  $args  = array(
    'posts_per_page' => -1,
    'post_type'      => 'pie_email',
    'tax_query'      => array(
      array(
        'taxonomy' => 'trigger',
        'field'    => $field,
        'terms'    => $trigger,
      )
    )
  );
  return get_posts( $args );
}

/**
 * Parse content to replace placeholders with User info
 *
 * @param string  $content Email content
 * @param WP_User $user    User object
 */
function pce_process_placeholders( $content, $user ) {
  $first_name     = get_user_meta( $user->ID, 'first_name', true ) ? get_user_meta( $user->ID, 'first_name', true ) : '{{user.first_name}}';
  $last_name      = get_user_meta( $user->ID, 'last_name', true ) ? get_user_meta( $user->ID, 'last_name', true ) : '{{user.last_name}}';
  return str_replace( array(
    '{{user.first_name}}',
    '{{user.last_name}}',
    '{{user.email}}',
    ), array(
      $first_name,
      $last_name,
      $user->user_email
    ),
    $content
  );
}
