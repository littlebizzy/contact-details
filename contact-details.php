<?php 
/*
Plugin Name: Contact Details
Plugin URI: https://www.littlebizzy.com/plugins/contact-details
GitHub Plugin URI: littlebizzy/contact-details
Description: Contact information shortcodes
Version: 0.0.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Forked from: https://wordpress.org/plugins/contact-details/
*/

// ensure class defined
if( !class_exists( 'LittleBizzy_Contact_Details' ) )
require_once( trailingslashit( dirname( __FILE__ ) ) . 'class.contact-details.php' );

new LittleBizzy_Contact_Details();
