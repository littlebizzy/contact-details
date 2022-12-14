<?php

// -- Contact Details! -- //

final class LittleBizzy_Contact_Details {

	public function __construct () {

		// Build up hooks
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );

		// Register primary shortcode
		add_shortcode( 'contact', array( __CLASS__, '_shortcode' ) );

	}

	public static function _shortcode ( $attributes ) {

		if( !isset( $attributes['type'] ) )
			return;

		if( $data = get_option( 'contact_details' ) ) {
			if( $attributes['type'] == 'email_address' ) {
				return antispambot( $data[$attributes['type']] );
			} else {
				return $data[$attributes['type']];
			}
		}
	
	}
	

	public static function admin_menu () {

		// Add menu page which allows the user to specify which post types to work with
		add_options_page( 'Contact Details', 'Contact Details', 'manage_options', 'contact-details', array( __CLASS__, '_options_page' )  );

	}

	public static function _options_page () {

		// Array for storing form structure
		$data = array(
			
			'Basic Details' => array(
				'primary_contact_name' => 'Primary Contact Name',
				'business_name' => 'Business Name',
				'location_name' => 'Location Name',
				'location_name_2' => 'Location Name 2',
				'phone_number' => 'Phone Number',
				'phone_number_2' => 'Phone Number 2',
				'fax' => 'Fax',
				'fax_2' => 'Fax 2',
				'email_address' => 'Email Address',
				'email_address_2' => 'Email Address 2',
				'address' => 'Address',
				'address_2' => 'Address 2',
				'city' => 'City',
				'city_2' => 'City 2',
				'postcode' => 'Postcode',
				'postcode_2' => 'Postcode 2',
				'state' => 'State',
				'state_2' => 'State 2',
				'country' => 'Country',
				'country_2' => 'Country 2',
				'business_hours' => 'Business Hours',
				'business_hours_2' => 'Business Hours 2',
				'id_number' => 'ID Number',
				'id_number_2' => 'ID Number 2',
				'facebook' => 'Facebook',
				'twitter' => 'Twitter',
				'instagram' => 'Instagram',
				'pinterest' => 'Pinterest',
				'linkedin' => 'LinkedIn',
				'youtube' => 'YouTube',
				'soundcloud' => 'SoundCloud',
				'myspace' => 'MySpace'
				),
		);

		// Render options in-line with WordPress core styling
		echo '<div class="wrap" id="post-navigator-settings">';

		echo '	<div class="icon32" id="icon-options-general"><br></div>';
		echo '	<h2>Contact Details</h2>';

		echo '	<p>Enter your contact details below. To display any particular contact details on your website, use the shortcode supplied.</p>';

		// Check if posting, if so, save data
		if( !empty( $_POST ) && isset( $_POST['_nonce'] ) ) {

			if( wp_verify_nonce( $_POST['_nonce'], '_contact_details' ) ) {

				echo '<div id="message" class="updated below-h2">';

				if( update_option( 'contact_details', array_map( 'sanitize_text_field', $_POST['contact_details'] ) ) )
					echo '<p>Successfully updated your Contact Details.</p>';
				else
					echo '<p class="error">Hmm.. looks like there was a problem. Please try again.</p>';

			}
			else {

				echo '<div id="message" class="error below-h2">';
				echo '<p>Could not verify this action. Please try again.</p>';

			}

			echo '</div>';

		}

		// Grab data
		$details = get_option( 'contact_details' );

		echo '	<form id="contact-details" name="contact-details" method="POST" action="#">';

		// Loop through "sections" and output form fields
		foreach( $data as $section => $fields ) {

			echo '<table class="widefat striped fixed"><thead><tr><th><strong>Field</strong></th><th><strong>Value</strong></th><th><strong>Shortcode</strong></th></tr></thead><tbody><div class="contact-details">';

			foreach( $fields as $key => $title ) {

				echo '<tr><td><label for="' . $key . '">' . $title . '</label></td>';
				echo '<td><input type="text" name="contact_details[' . $key . ']" value="' . esc_attr( $details[$key] ) . '" /></td>';
				echo '<td>[contact type="' . $key . '"]</td>';
				echo '</tr>';

			}

			echo '</div></tbody></table>';

		}

		echo '<br /><input type="hidden" name="_nonce" value="' . wp_create_nonce( '_contact_details' ) . '" />';
		echo '<input type="submit" value="Save Details" class="button button-primary" />';

		echo '	</form>';

		echo '</div>';

	}

}

?>
