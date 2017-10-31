//(function($){
jQuery(document).ready(function($){

  // Initialize a new plugin instance for $('.maidbooking input[type="range"]') element.
  $('.maidbooking input[type="range"]').rangeslider({

    // Feature detection the default is 'true'.
    // Set this to 'false' if you want to use
    // the polyfill also in Browsers which support
    // the native <input type="range"> element.
    polyfill: true

    });

  var totalPrice = $('.maidbooking .total-price');

  // function which calculates total price
  function price() {
    return ( $('.maidbooking #bedroom').val() * maidScriptParams.price_per_bedroom + $('.maidbooking #bathroom').val() * maidScriptParams.price_per_bathroom + maidScriptParams.base_price * 1 ) * $(".repetition :radio:checked").val();
  }

  // display starting total price
  totalPrice.text( price() );
  
  // create jquery ui buttonset
  $('.maidbooking .repetition').buttonset();

  // update sliders and total price
  $('.maidbooking input[type="range"]').on('change mousemove', function() {

    var plural = '';

    if ( $(this).val() > 1 ) plural = 's';

    $('label[for="'+$(this).attr('id')+'"]').html('<strong>'+$(this).val()+'</strong> '+$(this).attr('id')+ plural );

    totalPrice.text( price() );

  });

  // update total price when buttonset is clicked
  $('.maidbooking .repetition input[type="radio"]').on('click', function() {

    totalPrice.text( price() );

  });

});
//})(jQuery);