<?php
/**
 * Register custom post types and taxonomies
 */
 if ( ! defined( 'ABSPATH' ) ) {
 	exit; // Exit if accessed directly
 }

 if ( ! class_exists( 'PIE_Custom_Emails_Register' ) ) {
   class PIE_Custom_Emails_Register {

     /**
      * Load hooks
      */
     public function init() {
       add_action( 'init', array( $this, 'register_post_type' ) );
       add_action( 'init', array( $this, 'register_taxonomy' ) );
       add_action( 'init', array( $this, 'register_taxonomy_to_post' ) );
     }

     /**
      * Register custom post for emails
      */
     public function register_post_type() {
       $labels = array(
         'name'                  => _x( 'Emails', 'Post type general name', 'pie-custom-emails' ),
         'singular_name'         => _x( 'Email', 'Post type singular name', 'pie-custom-emails' ),
         'menu_name'             => _x( 'Emails', 'Admin Menu text', 'pie-custom-emails' ),
         'name_admin_bar'        => _x( 'Email', 'Add New on Toolbar', 'pie-custom-emails' ),
         'add_new'               => __( 'Add New', 'pie-custom-emails' ),
         'add_new_item'          => __( 'Add New Email', 'pie-custom-emails' ),
         'new_item'              => __( 'New Email', 'pie-custom-emails' ),
         'edit_item'             => __( 'Edit Email', 'pie-custom-emails' ),
         'view_item'             => __( 'View Email', 'pie-custom-emails' ),
         'all_items'             => __( 'All Emails', 'pie-custom-emails' ),
         'search_items'          => __( 'Search Emails', 'pie-custom-emails' ),
         'not_found'             => __( 'No emails found.', 'pie-custom-emails' ),
         'not_found_in_trash'    => __( 'No emails found in Trash.', 'pie-custom-emails' ),
         'featured_image'        => _x( 'Email Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'pie-custom-emails' ),
         'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'pie-custom-emails' ),
         'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'pie-custom-emails' ),
         'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'pie-custom-emails' ),
         'archives'              => _x( 'Email archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'pie-custom-emails' ),
         'insert_into_item'      => _x( 'Insert into email', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'pie-custom-emails' ),
         'uploaded_to_this_item' => _x( 'Uploaded to this email', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'pie-custom-emails' ),
         'filter_items_list'     => _x( 'Filter emails list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'pie-custom-emails' ),
         'items_list_navigation' => _x( 'Emails list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'pie-custom-emails' ),
         'items_list'            => _x( 'Emails list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'pie-custom-emails' ),
       );

       $args = array(
         'labels'              => $labels,
         'public'              => true,
         'publicly_queryable'  => false,
         'exclude_from_search' => true,
         'show_ui'             => true,
         'show_in_menu'        => true,
         'query_var'           => true,
         'menu_icon'           => 'dashicons-email-alt',
         'supports'            => array( 'title', 'editor', 'excerpt' ),
       );
       register_post_type( 'pie_email', $args );
     }

     /**
      * Register trigger taxonomy for email post type
      */
     public function register_taxonomy() {
       $labels = array(
         'name'              => _x( 'Triggers', 'taxonomy general name', 'pie-custom-emails' ),
         'singular_name'     => _x( 'Trigger', 'taxonomy singular name', 'pie-custom-emails' ),
         'search_items'      => __( 'Search Triggers', 'pie-custom-emails' ),
         'all_items'         => __( 'All Triggers', 'pie-custom-emails' ),
         'parent_item'       => __( 'Parent Trigger', 'pie-custom-emails' ),
         'parent_item_colon' => __( 'Parent Trigger:', 'pie-custom-emails' ),
         'edit_item'         => __( 'Edit Trigger', 'pie-custom-emails' ),
         'update_item'       => __( 'Update Trigger', 'pie-custom-emails' ),
         'add_new_item'      => __( 'Add New Trigger', 'pie-custom-emails' ),
         'new_item_name'     => __( 'New Trigger Name', 'pie-custom-emails' ),
         'menu_name'         => __( 'Triggers', 'pie-custom-emails' ),
       );

       $args = array(
         'labels'            => $labels,
         'show_ui'           => true,
         'show_admin_column' => true,
         'show_in_menu'      => true,
         'show_in_rest'      => true,
       );
       register_taxonomy( 'trigger', array( 'pie_email' ), $args );
     }

     /**
      * Make sure connection is made between taxonomy and post
      */
     public function register_taxonomy_to_post() {
       register_taxonomy_for_object_type( 'trigger', 'pie_email' );
     }
   }
 }
