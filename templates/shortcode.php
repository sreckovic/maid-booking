<div class="maidbooking" style="width: <?php echo $atts['width'] ?>;">
  
  <?php 

  $maid_title = get_option( 'maid_title');
  $maid_subtitle = get_option( 'maid_subtitle');

  if ( !empty( $maid_title ) ) echo '<h2>' . esc_html( get_option( 'maid_title' ) ) . '</h2>';
  if ( !empty( $maid_subtitle ) ) echo '<p>' . esc_html( get_option( 'maid_subtitle' ) ) . '</p>';
  
  ?>

  <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="post">

    <label for="bedroom"><strong>1</strong> Bedroom</label>
    <input type="range" id="bedroom" name="bedroom" min="1" value="1" max="<?php echo esc_attr( get_option( 'max_bedrooms', '5' ) ); ?>" step="1">

    <label for="bathroom"><strong>1</strong> Bathroom</label>
    <input type="range" id="bathroom" name="bathroom" min="0" value="1" max="<?php echo esc_attr( get_option( 'max_bathrooms', '5' ) ); ?>" step=".5">

    <div class="repetition">

      <input type="radio" id="once" name="rep" value="1">
      <label for="once"><?php _e( 'One time service', 'maid-booking') ?></label>

      <input type="radio" id="week" name="rep" value=".8" checked="checked">
      <label for="week"><?php echo __( 'Every week', 'maid-booking') . ' 20% ' . __( 'off', 'maid-booking'); ?></label>

      <input type="radio" id="week-2" name="rep" value=".85">
      <label for="week-2"><?php echo __( 'Every 2 weeks', 'maid-booking') . ' (' . __( 'Popular', 'maid-booking') . ')' . ' 15% ' .  __( 'off', 'maid-booking'); ?></label>

      <input type="radio" id="week-4" name="rep" value=".90">
      <label for="week-4"><?php echo __( 'Every 4 weeks', 'maid-booking') . ' 10% ' . __( 'off', 'maid-booking');  ?></label>

    </div>

    <input type="text" name="maid-email" placeholder="<?php _e( 'Your email address', 'maid-booking') ?>" />

    <button name="maid-submitted" style="color: <?php echo $atts['color'] ?>; background: <?php echo $atts['bg'] ?>"><?php echo esc_attr( get_option( 'maid_button_text' ) ); ?> <span class="price">$<span class="total-price">0</span>/<?php _e( 'clean', 'maid-booking' ); ?></span></button>

  </form>

</div>