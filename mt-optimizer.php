<?php

function mediatemple_admin_pages() {
add_submenu_page( 'tools.php', '(mt) Optimizer', '(mt) Optimizer', 'manage_options', 'mt-optimizer', 'mt_optimzer_page_callback' );
}
add_action('admin_menu', 'mediatemple_admin_pages');


function mt_optimzer_page_callback() {

	echo '<div class="wrap" style="width:90%;">';
		echo '<h2>(mt) Media Temple Optimizer</h2>';

		?>

		<p>Currently this tool is a work in progress.</p>

	<!--	<p>Optimizer shows different stuff based on service.</p>

		<h4>Possible Features / Items to check</h4>
		<hr>

		* Does Domain point to (mt) Nameservers or CloudFlare?<br />
		* PHP Settings optimized for WordPress?<br />
		* Check db for old staging url, find and replace feature (Dev Mode/Production Mode).<br />
		* Does client have a ProCDN service?<br />
		* Does client have a MySQL Container?<br />
		* Does client have CloudFlare enabled?<br />
		* Recommended Plugins - W3 Total Cache?<br />
		* Script to setup APC?<br />
		* View GS Logs? Delete them?<br />
		* Security Check?<br />
		* Performance settings in wp-config
		* List all of the users other (mt) Services
-->


		<h4>Current PHP Settings:</h4>
		<hr>
		<?php

		$memory_limit = ini_get('memory_limit');
		$post_max_size = ini_get('post_max_size');
		$upload_max_filesize = ini_get('upload_max_filesize');
		$max_execution_time = ini_get('max_execution_time');

		$phpversion = phpversion();
		echo 'Current PHP Version: ' . $phpversion . '<br />';

		echo 'Current PHP Memory Limit: ' . $memory_limit;



	echo '</div>';





}