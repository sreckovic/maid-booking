<div class="wrap maidbooking">
  <?php @screen_icon(); ?>
  <h1> <?php _e( 'Maid booking', 'maid-booking' ); ?> </h1>

  <?php
  /* $active_tab = "general";
  
  if( isset( $_GET["tab"] ) ) {
    if($_GET["tab"] == "general") {
      $active_tab = "general";
    } else {
      $active_tab = "pricing";
    }
  } */
  ?>

  <!--h2 class="nav-tab-wrapper">
  <a href="?page=maid-booking&tab=general" class="nav-tab <?php //if ($active_tab == 'general') { echo 'nav-tab-active'; } ?> "><?php //_e( 'General', 'maid-booking' ); ?></a>
  <a href="?page=maid-booking&tab=pricing" class="nav-tab <?php //if ($active_tab == 'pricing') { echo 'nav-tab-active'; } ?>"><?php //_e( 'Pricing', 'maid-booking' ); ?></a>
  </h2-->

  <form method="post" action="options.php">

    <?php @settings_fields( 'maid_options-group' ); ?>
    <?php @do_settings_sections( 'maid_options-group' ); ?>

    <?php
    /*
    if ( isset( $_GET["tab"] ) ) {
      if ( $_GET["tab"] == "general" ) { } else { }
    } else { }
    */
    ?>

    <table class="form-table">

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Title', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="maid_title" value="<?php echo esc_attr( get_option('maid_title') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Subtitle', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="maid_subtitle" value="<?php echo esc_attr( get_option('maid_subtitle') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Button text', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="maid_button_text" value="<?php echo esc_attr( get_option('maid_button_text') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Max number of Bedrooms', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="max_bedrooms" value="<?php echo esc_attr( get_option('max_bedrooms') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Max number of Bathrooms', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="max_bathrooms" value="<?php echo esc_attr( get_option('max_bathrooms') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Base Price', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="base_price" value="<?php echo esc_attr( get_option('base_price') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Price per Bedroom', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="price_per_bedroom" value="<?php echo esc_attr( get_option('price_per_bedroom') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Price per Bathroom', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="price_per_bathroom" value="<?php echo esc_attr( get_option('price_per_bathroom') ); ?>" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label><?php _e( 'Email', 'maid-booking' ); ?></label></th>
        <td><input type="text" name="supervisor_email" value="<?php echo esc_attr( get_option('supervisor_email') ); ?>" /></td>
      </tr>

    </table>

    <?php @submit_button(); ?>

  </form>
</div>