<?php  
/* 
    Plugin Name: Sirportly 
    Description: Sirportly integration
    Author: Daniel Quinney <danq@atechmedia.com>
    Version: 1.0.0
*/  

add_action('admin_init', 'sirportly_init');
function sirportly_init(){
  register_setting(
    'general',                // settings page
    'sirportly_options'       // option name
  );
  add_settings_field(
    'sirportly_api_url',      // id
    'Sirportly API URL',      // setting title
    'sirportly_api_url',      // display callback
    'general',                // settings page
    'default'                 // settings section
  );

  add_settings_field(
    'sirportly_api_token',    // id
    'Sirportly API Token',    // setting title
    'sirportly_api_token',    // display callback
    'general',                // settings page
    'default'                 // settings section
  );

  add_settings_field(
    'sirportly_api_secret',   // id
    'Sirportly API Secret',   // setting title
    'sirportly_api_secret',   // display callback
    'general',                // settings page
    'default'                 // settings section
  );

  register_setting(
    'general',                // settings page
    'sirportly_options'       // option name
  );
}

## api url field
function sirportly_api_url(){
  $options = get_option( 'sirportly_options' );
  echo "<input id='api_url' name='sirportly_options[api_url]' type='text' value='". esc_attr( $options['api_url'] ) ."' /> ";
}

## api token field
function sirportly_api_token(){
  $options = get_option( 'sirportly_options' );
  echo "<input id='api_token' name='sirportly_options[api_token]' type='text' value='". esc_attr( $options['api_token'] ) ."' class='regular-text ltr' /> ";
}

## api secret field
function sirportly_api_secret(){
  $options = get_option( 'sirportly_options' );
  echo "<input id='api_secret' name='sirportly_options[api_secret]' type='text' value='". esc_attr( $options['api_secret'] ) ."' class='regular-text ltr' /> ";
}

function sirportly_shortcode($atts) {

  ## Check attributes
  if ( !$atts['brand'] || !$atts['department'] || !$atts['status'] || !$atts['priority'] ) { return 'Unable to show form due to missing parameters.'; }

  if ( $_POST && wp_verify_nonce($_POST['sirportly_form_submit'],'sirportly') ){

    ## display the ugly wordpress error page unless the user has entered all the details.
    if ( !$_POST['subject'] || !$_POST['customer_name'] || !$_POST['email'] || !$_POST['content'] ) {
      echo '<script type="text/javascript"> alert("Please fill the required fields (name, email, subject and message)."); </script>';
    }
    
    $options = get_option( 'sirportly_options' );

    $ticket = wp_remote_post( 'http://'.$options['api_url'].'/api/v1/tickets/submit', array(
      'method' => 'POST',
      'headers' => array('X-Auth-Token' => $options['api_token'], 'X-Auth-Secret' => $options['api_secret']),
      'body' => array(
        'brand'      => $atts['brand'],
        'department' => $atts['department'],
        'priority'   => $atts['priority'],
        'status'     => $atts['status'],
        'subject'    => $_POST['subject'],
        'name'       => $_POST['customer_name'],
        'email'      => $_POST['email'],
        'message'    => $_POST['content']
      )
    ));
    
    $json = json_decode($ticket['body'],true);

    if ( !count( $json['errors'] ) ) {
      echo ($atts['confirmation'] ? $atts['confirmation'] : 'Thanks for contacting us! We will get in touch with you shortly.');
    } else {
      require('form.php');
    }       
    
  } else {
    require('form.php');
  }
}

add_shortcode('sirportly', 'sirportly_shortcode');