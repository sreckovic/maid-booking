<?php

if ( !class_exists('Maid_Settings') ) {

  class Maid_Settings {

    /**
     * Construct the object
     */
    public function __construct() {

      // register actions
      add_action( 'admin_init', array( $this, 'admin_init' ) );
      add_action( 'admin_menu', array( $this, 'add_menu' ) );
    }

    /**
     * Hook into WP's admin_init action hook
     */
    public function admin_init() {

      // Set up the settings
      $this->init_settings();
    }

    /**
     * Initialize our custom settings
     */
    public function init_settings() {

      // register the settings
      register_setting( 'maid_options-group', 'maid_title', '' );
      register_setting( 'maid_options-group', 'maid_subtitle', '' );
      register_setting( 'maid_options-group', 'maid_button_text', '' );
      register_setting( 'maid_options-group', 'max_bedrooms', 'intval' );
      register_setting( 'maid_options-group', 'max_bathrooms', 'floatval' );
      register_setting( 'maid_options-group', 'base_price', array( $this, 'base_price_callback' ) );
      register_setting( 'maid_options-group', 'price_per_bathroom', 'intval' );
      register_setting( 'maid_options-group', 'price_per_bedroom', 'intval' );
      register_setting( 'maid_options-group', 'supervisor_email', '' );
    }

    /**
     * Callback functions for register_setting's
     */
    function base_price_callback( $input ) {
      if ( !empty( $input ) ) { return intval( $input ); } else { return $input = 10; }
    }

    /* function button_text_callback( $input ) {
      if ( empty( $input ) ) { return $input = __( 'Schedule an appointment', 'maid-booking' ); }
    } */

    /**
     * Add a menu
     */

    public function add_menu() {
      $maidpage = add_options_page( 'Maid booking', 'Maid booking', 'manage_options', 'maid-booking', array( $this, 'settings_page' ) );
      add_action( "admin_print_scripts-$maidpage", array( $this, 'add_admin_head' ) );
    }

    /**
     * Add scripts to settings page
     */
    public function add_admin_head() {
      // load maid settings page css file
      echo '<link rel="stylesheet" href="' . plugins_url('css/maid_admin_styles.css', __FILE__) . '" type="text/css" />\n';
    }

    /**
     * Menu Callback
     */

    public function settings_page() {

      if ( !current_user_can('manage_options') ) {
        wp_die( __('You do not have sufficient permissions to access this page.') );
      }

      // render the settings template
      include( sprintf( "%s/templates/settings.php", dirname(__FILE__) ) );
    }

  }

}