<?php
/**
 * Plugin Name: Custom Emails
 * Plugin URI: #
 * Description: Adds a custom post type for emails
 * Version: 0.0.1
 * Author: The team at PIE
 * Author URI: https://pie.co.de
 * Text Domain: pie-custom-emails
 */
 if ( ! defined( 'ABSPATH' ) ) {
 	exit; // Exit if accessed directly
 }

 if ( ! class_exists( 'PIE_Custom_Emails' ) ) {
   class PIE_Custom_Emails {

     /**
    	* The single instance of the class
    	*
    	* @var PIE_Custom_Emails
    	*/
    	protected static $_instance = null;

     /**
      * PIE_Custom_Emails __construct
      */
     public function __construct() {
       $this->load_plugin();
     }

     /**
      * Load plugin
      */
     public function load_plugin() {
       require_once 'helper-functions.php';
       require_once 'classes/pie-custom-emails-register.php';
       $register = new PIE_Custom_Emails_Register;
       $register->init();
     }

     /**
  	  * Plugin Instance
      *
  	  * @return PIE_Custom_Emails Main instance
  	  */
    	public static function instance() {
    		if ( is_null( self::$_instance ) ) {
    			self::$_instance = new self();
    		}
    		return self::$_instance;
    	}
   }
   PIE_Custom_Emails::instance();
 }
