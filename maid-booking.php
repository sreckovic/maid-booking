<?php

/**
 * Plugin Name: Maid Booking
 * Plugin URI: http://igloothemes.com/maid-booking
 * Description: This plugin adds a simple maid booking shortcode.
 * Version: 1.0.1
 * Author: Igloo themes
 * Author URI: http://igloothemes.com
 * License: GPL2
 * Text Domain: maid-booking
 * Domain Path: /languages
 */

/**
 * Copyright 2016  Prinli  (email : nemanja.sreckovic@gmail.com)
 */

if ( !class_exists('MaidBooking') ) {

  class MaidBooking {

    /**
     * Construct the object
     */
    public function __construct() {

      define( 'VERSION', 1);

      // initialize settings
      require_once(sprintf("%s/settings.php", dirname(__FILE__)));
      $maid_settings = new Maid_Settings();

      // register custom post types
      /*
      require_once(sprintf("%s/post-types/booking.php", dirname(__FILE__)));
      $Booking = new Booking();
      */

      // add a link to the settings page onto the plugin page
      $plugin = plugin_basename(__FILE__);
      add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));

      // register actions
      add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
      add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
      //add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

      // register shortcode
      add_shortcode( 'maid_slider', array( $this, 'slider_shortcode' ) );
    }

    /**
     * Activate the plugin
     */
    public static function activate() {
      add_option( 'maid_title', __( 'Most affortable cleaning service', 'maid-booking' ), '' );
      add_option( 'maid_subtitle', __( 'Book a trusted maid instantly below.', 'maid-booking' ), '' );
      add_option( 'maid_button_text', __( 'Schedule an appointment', 'maid-booking' ), '' );
      add_option( 'max_bedrooms', '8' );
      add_option( 'max_bathrooms', '4' );
      add_option( 'base_price', '50' );
      add_option( 'price_per_bathroom', '20' );
      add_option( 'price_per_bedroom', '10' );
      add_option( 'supervisor_email', get_option( 'admin_email' ) );

      /*
      $my_page = array(
        'post_title' => 'Our New Auto-Created Page',
        'post_content' => '[maid_slider]',
        'post_status' => 'publish',
        'post_type' => 'page'
      );

      global $post_id; // not working? #todo

      $post_id = wp_insert_post($my_page);
      */
    }

    /**
     * Deactivate the plugin
     */
    public static function deactivate() {
      delete_option( 'maid_title' );
      delete_option( 'maid_subtitle' );
      delete_option( 'maid_button_text');
      delete_option( 'max_bedrooms');
      delete_option( 'max_bathrooms');
      delete_option( 'base_price');
      delete_option( 'price_per_bathroom');
      delete_option( 'price_per_bedroom');
      delete_option( 'supervisor_email');

      wp_delete_post($post_id); // not working? #todo
    }

    /**
     * Load text domain
     */
    function load_text_domain() {
      //dirname( plugin_basename( __FILE __ ) )
      $locale = apply_filters('plugin_locale', get_locale(), 'maid-booking' );
      load_textdomain('maid-booking', WP_LANG_DIR . 'maid-booking' . $locale . '.mo' );
      load_plugin_textdomain( 'maid-booking', FALSE, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
    }
    
    /* moved to settings.php, so it just load on settings page
    function admin_scripts( $hook ) {
      if ( 'post.php' != $hook ) ]
        return;
      wp_enqueue_style( 'maid-booking-admin-style', plugins_url('css/maid_admin_styles.css', __FILE__), array() );
    }
    */

    function scripts() {
      global $post;
      if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'maid_slider') ) {
        wp_enqueue_script( 'maid-rangeslider', plugins_url('js/rangeslider.min.js', __FILE__), array('jquery'), '', true );
        wp_enqueue_script( 'maid-script', plugins_url('js/maid.js', __FILE__), array('jquery', 'jquery-ui-button'), VERSION, true );
        wp_enqueue_style( 'maid-jquery-ui-style', plugins_url('css/jquery-ui.min.css', __FILE__), array() );
        wp_enqueue_style( 'maid-style', plugins_url('css/maid_styles.css', __FILE__), array() );

        $maid_script_params = array(
          'price_per_bathroom' => get_option( 'price_per_bathroom' ),
          'price_per_bedroom' => get_option( 'price_per_bedroom' ),
          'base_price' => get_option( 'base_price' )
        );

        wp_localize_script( 'maid-script', 'maidScriptParams', $maid_script_params );
      }
    }

    // add the settings link to the plugins page
    function plugin_settings_link($links) {
      $settings_link = '<a href="options-general.php?page=maid-booking">' . __( 'Settings', 'maid-booking' ) . '</a>';
      array_unshift($links, $settings_link);
      return $links;
    }

    // add shortcode
    function slider_shortcode( $atts ) {

      ob_start();

      $atts = shortcode_atts( array( 'color' => '#fff', 'bg' => '#007acc', 'width' => '100%' ), $atts, 'maid_slider' );

      include( sprintf( "%s/templates/shortcode.php", dirname(__FILE__) ) );

      if ( isset( $_POST['maid-submitted'] ) ) {

          $email = sanitize_email( $_POST["maid-email"] );
          $bedroom = sanitize_text_field( $_POST["bedroom"] );
          $bathroom = sanitize_text_field( $_POST["bathroom"] );
          $repetition = sanitize_text_field( $_POST["rep"] );

        if ( empty( $email ) ) {

          echo '<p class="maid-error">' . __( 'Please enter email address, thanks', 'maid-booking') . '.</p>';

        } else {

          $name = 'Maid Booking';
          $subject = 'Maid Booking Form Submitted';
          $message = __( 'From ', 'maid-booking') . $email . ', '. __( 'Repetition ', 'maid-booking') . $repetition . ', ' . __( 'Num. of bedrooms ', 'maid-booking') . $bedroom . ', ' . __( 'Num. of bathrooms ', 'maid-booking') . $bathroom;

          $to = get_option( 'supervisor_email' );

          $headers = "From: " . $name . "<wordpress@ ". preg_replace('/^www\./','',$_SERVER['SERVER_NAME']) .">\r\n";

          if ( wp_mail( $to, $subject, $message, $headers ) ) {
            echo '<p class="maid-confirmation">' . __( 'Thanks for contacting us, expect a response soon.', 'maid-booking') . '</p>';
          } else {
            echo __( 'Error occurred ', 'maid-booking');
          }

        }
      }

      return ob_get_clean();

    }
  }
}

if ( class_exists('MaidBooking') ) {

  // installation and uninstallation hooks
  register_activation_hook( __FILE__, array('MaidBooking', 'activate') );
  register_deactivation_hook( __FILE__, array('MaidBooking', 'deactivate') );

  // instantiate the plugin class
  $maid = new MaidBooking();
}
