<?php
/*
Plugin Name: AM PayPal donation button
Plugin URI: http://ayoubmedia.com/wp-plugins/paypal?ref=wp
Description: Just drop this widget on a widget area, fill in your data and you are ready to accept donations. To insert donation button in your post open settings page under 'Settings' menu.
Version: 1.1
Author: Ayoub Media
Author URI: http://ayoubmedia.com?ref=wp
License: GPL2
*/

define( 'AMPAYPALBUTTON_NAME', 'AM PayPal donation button');
define( 'AMPAYPALBUTTON_VERSION', '1.1');
define( 'AMPAYPALBUTTON_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'AMPAYPALBUTTON_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once (AMPAYPALBUTTON_PLUGIN_DIR."paypal-widget.inc.php");

if ( is_admin() ) {
	require_once( AMPAYPALBUTTON_PLUGIN_DIR . 'settings.inc.php' );
} else {
function am_paypal_donation_button_filter($content) {
	if (strstr($content,"[am_paypal_donation_button]")){
	define("_am_paypal_button_",true);	
    ob_start();
	include AMPAYPALBUTTON_PLUGIN_DIR."paypal-button.inc.php";;
	$donationForm = ob_get_contents();
	ob_end_clean();
	return str_replace("[am_paypal_donation_button]",$donationForm,$content);
	}
	else
	return $content;
}
add_filter( 'the_content', 'am_paypal_donation_button_filter' );
}
?>