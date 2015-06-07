<?php

################################################################################
// Create Settings Page
################################################################################


// create custom plugin settings menu
add_action('admin_menu', 'mediatemple_create_menu');

function mediatemple_create_menu() {

  //create our settings page
  add_options_page( '(mt) Media Temple', '(mt) Media Temple', 'manage_options', 'mediatemple', 'mediatemple_settings_page' );

  //call register settings function
  add_action( 'admin_init', 'mediatemple_register_settings' );
}

// Register our Settings
function mediatemple_register_settings() {
$mediatemple_apikey =  get_option( 'mediatemple_apikey' );
  register_setting( 'mediatemple-settings-group', 'mediatemple_apikey' );
  register_setting( 'mediatemple-settings-group', 'mediatemple_wp_this_service' );
  add_settings_section( 'mediatemple-section', 'Media Temple', 'mediatemple_section_callback', 'mediatemple' );
  add_settings_field( 'mediatemple-apikey-field', 'Media Temple API Key', 'mediatemple_apikey_field_callback', 'mediatemple', 'mediatemple-section' );
if ( !empty($mediatemple_apikey) ) {
  add_settings_field( 'mediatemple-service-field', 'Which service is this WordPress hosted on?', 'mediatemple_service_field_callback', 'mediatemple', 'mediatemple-section' );
    add_settings_field( 'mediatemple-cloudflare-field', 'Are you using CloudFlare for this site?', 'mediatemple_cloudflare_field_callback', 'mediatemple', 'mediatemple-section' );
  }

}



function mediatemple_section_callback() {
	?>

	<div style="float:right;">
<a href="http://mediatemple.net#a_aid=4f1cea947bfc1&amp;a_bid=8524a5cd" target="_top" rel="nofollow"><img src="https://affiliate.mediatemple.net/accounts/default1/banners/grid40 250x250.png" alt="" width="300" height="250" /></a><img style="border:0" src="https://affiliate.mediatemple.net/scripts/imp.php?a_aid=4f1cea947bfc1&amp;a_bid=8524a5cd" width="1" height="1" alt="" />
	</div>

	<div style="float:left;">
	<p>When configured, this will allow you to view information regarding your (mt) Media Temple service, as well as optimize WordPress for the service.</p>

	<?php
}

// Field for MediaTemple API Key
function mediatemple_apikey_field_callback() {
    $mediatemple_apikey =  get_option( 'mediatemple_apikey' );
    echo "<input id='mediatemple_apikey_input' type='text' name='mediatemple_apikey' value='$mediatemple_apikey' style='width:600px;' />";
    echo "<p>You can <a href='https://kb.mediatemple.net/questions/1855/' target='_blank'>Generate an API Key</a> within your AccountCenter.</p>";
}

// Dropdown for MediaTemple Service
function mediatemple_service_field_callback() {

    $mediatemple_apikey = get_option( 'mediatemple_apikey' );

    // Headers for API Call
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
    );

    $mediatemple_services_json = wp_remote_get( 'https://api.mediatemple.net/api/v1/services.json?apikey=' . $mediatemple_apikey,  array( 'sslverify' => true, 'headers' => $headers)  );

    // Decode Json
    $mediatemple_services = json_decode($mediatemple_services_json['body'], true);
    $mediatemple_services_item = $mediatemple_services['services'];

?>


<select name="mediatemple_wp_this_service" id="mediatemple_wp_this_service">
    <option value="">Select a Service</option>
    <?php

		// Set our Service Option
		$mediatemple_wp_this_service = get_option( 'mediatemple_wp_this_service' );
		$mediatemple_wp_this_servicetype = get_option( 'mediatemple_wp_this_servicetype' );

		// Create our Dropdown
		foreach($mediatemple_services_item as $mediatemple_service){

            $meditemple_service_id = $mediatemple_service['id'];
            $mediatemple_servicetype = $mediatemple_service['serviceType'];
            $mediatemple_service_typename = $mediatemple_service['serviceTypeName'];
            $mediatemple_service_primarydomain = $mediatemple_service['primaryDomain'];
            $mediatemple_service_accessdomain = $mediatemple_service['accessDomain'];

            $selected = ($mediatemple_wp_this_service==$meditemple_service_id) ? 'selected="selected"' : '';

			if ($mediatemple_servicetype!==739) {

			echo "<option value='$meditemple_service_id' $selected>$mediatemple_service_typename ($mediatemple_service_primarydomain) </option>";

			} // end if

        } // end foreach

		echo "</select>";
}



// Dropdown for MediaTemple Service
function mediatemple_cloudflare_field_callback() {

	$mediatemple_using_cloudflare = get_option( 'mediatemple_using_cloudflare' );

	 $selected = ($mediatemple_using_cloudflare==$mediatemple_using_cloudflare) ? 'selected="selected"' : '';
	 ?>

	<select name="mediatemple_using_cloudflare" id="mediatemple_using_cloudflare">
			<option value="">Choose</option>
	<?php	echo "<option value='$mediatemple_using_cloudflare = 0' $selected>No</option>";
			echo "<option value='$mediatemple_using_cloudflare = 1' $selected>Yes</option>";

}




// OUTPUT OUR PAGE
function mediatemple_settings_page() { ?>
    <div class="wrap" style="width:90%;">
        <form method="post" action="options.php">
            <?php settings_fields( 'mediatemple-settings-group' ); ?>
             <?php do_settings_sections( 'mediatemple' ); ?>
            <?php submit_button('Save Changes', 'button-primary', 'submit-mediatemple-settings', true); ?>

        </form>
    </div>
	</div>
    <?php
}


