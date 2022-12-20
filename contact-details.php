<?php 
/*
Plugin Name: Contact Details
Plugin URI: https://www.littlebizzy.com/plugins/contact-details
Description: Contact information shortcodes
Version: 1.1.2
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
GitHub Plugin URI: https://github.com/littlebizzy/contact-details
Primary Branch: main
Forked from: https://wordpress.org/plugins/contact-details/
*/

// disable wordpress.org updates
add_filter(
    'gu_override_dot_org',
    function ( $overrides ) {
        return array_merge(
            $overrides,
            array( 'contact-details/contact-details.php' )
        );
    }
);

// ensure class defined
if( !class_exists( 'LittleBizzy_Contact_Details' ) )
require_once( trailingslashit( dirname( __FILE__ ) ) . 'class.contact-details.php' );

new LittleBizzy_Contact_Details();
