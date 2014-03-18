<?php

/*
* DV - Level 1 = Type 796

*/




################################################################################
// (mt) Media Temple KnowledgeBase Widget
################################################################################
function mtknowledgebase_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', '(mt) Media Temple - KnowledgeBase', 'custom_dashboard_help');
}

function custom_dashboard_help() {
?>
		  <form style="display: inline;" method="get" action="http://kb.mediatemple.net/search.php">
				<input name="Query" type="text" placeholder="Enter Keywords" />
				<input type="submit" class="button button-primary" value="Search"  />
		  </form>

		  <h4 style="margin-top:5px;font-weight:bold;">Featured Articles</h4>
		  <hr>
<?php

	wp_widget_rss_output(array(
            'url' => 'https://kb.mediatemple.net/rss.php?c=&t=featured',
            'title' => 'Featured Articles',
            'items' => 3, //how many posts to show
            'show_summary' => 1, // 0 = false and 1 = true
            'show_author' => 0,
            'show_date' => 1
       ));


}

add_action('wp_dashboard_setup', 'mtknowledgebase_dashboard_widgets');

################################################################################
// (mt) Media Temple Blog Widget
################################################################################
function mtblog_rss_output(){
       wp_widget_rss_output(array(
            'url' => 'http://weblog.mediatemple.net/feed/',
            'title' => '(mt) Media Temple - Latest News',
            'items' => 3, //how many posts to show
            'show_summary' => 1, // 0 = false and 1 = true
            'show_author' => 0,
            'show_date' => 1
       ));
}

// Hook into wp_dashboard_setup and add our mt widget
add_action('wp_dashboard_setup', 'mtblog_rss_widget');

// Create the function that adds the mt widget
function mtblog_rss_widget(){
  // Add our RSS widget
  wp_add_dashboard_widget( 'mtblog-rss', '(mt) Media Temple - Latest News', 'mtblog_rss_output');
}

################################################################################
// (mt) Media Temple System Status Incidents Dashboard Widget
################################################################################
function mt_systemstatus_dashboard_widget(){
		wp_widget_rss_output(array(
            'url' => 'http://status.mediatemple.net/history.rss',  //put your feed URL here
            'title' => '(mt) Media Temple - System Status',
            'items' => 5,
            'show_summary' => 0, // 0 = false and 1 = true
            'show_author' => 0,
            'show_date' => 1
        ));

	}

// Load our Widget onto Dasboard
function load_mt_systemstatus_dashboard_widget(){
	wp_add_dashboard_widget( 'mt-systemstatus-incidents-dashboard-widget', '(mt) Media Temple - System Status', 'mt_systemstatus_dashboard_widget');
	}
add_action('wp_dashboard_setup', 'load_mt_systemstatus_dashboard_widget');





################################################################################
// (mt) Media Temple Service info Dashboard Widget
################################################################################
function mt_serviceinfo_output_dashboard_widget(){

	$mediatemple_apikey = get_option( 'mediatemple_apikey' );
	$mediatemple_wp_this_service = get_option( 'mediatemple_wp_this_service' );

	if ( empty( $mediatemple_apikey ) OR empty( $mediatemple_wp_this_service ) ) {
		echo 'Your (mt) API key and/or service ID are not set. <a href="' . get_admin_url() . 'options-general.php?page=mediatemple">Enter them here!</a>';
		return;
	}

    // Headers for API Call
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
    );

    $mediatemple_servicedetails_json = wp_remote_get( 'https://api.mediatemple.net/api/v1/services/' . $mediatemple_wp_this_service . '?apikey=' . $mediatemple_apikey,  array( 'sslverify' => true, 'headers' => $headers)  );

     // Decode Json
    $mediatemple_servicedetails = json_decode($mediatemple_servicedetails_json['body'], true);

	foreach($mediatemple_servicedetails as $mediatemple_servicedetail){

            $meditemple_service_id = $mediatemple_servicedetail['id'];
            $mediatemple_servicetype = $mediatemple_servicedetail['serviceType'];
            $mediatemple_service_typename = $mediatemple_servicedetail['serviceTypeName'];
            $mediatemple_service_primarydomain = $mediatemple_servicedetail['primaryDomain'];
            $mediatemple_service_accessdomain = $mediatemple_servicedetail['accessDomain'];
            $mediatemple_service_ipAddresses = $mediatemple_servicedetail['ipAddresses'];
            $mediatemple_service_hostServer = $mediatemple_servicedetail['hostServer'];
            $mediatemple_service_billingStatus = $mediatemple_servicedetail['billingStatus'];
            $mediatemple_service_billingStatusText = $mediatemple_servicedetail['billingStatusText'];
            $mediatemple_service_operatingSystem = $mediatemple_servicedetail['operatingSystem'];
            $mediatemple_service_operatingSystemName = $mediatemple_servicedetail['operatingSystemName'];
            $mediatemple_service_pendingReboot = $mediatemple_servicedetail['pendingReboot'];
            $mediatemple_service_addons = $mediatemple_servicedetail['addons'];


			/* IF GS / GS Lite */
			if ($mediatemple_servicetype == '396') {
			?>

			<p>Your site is currently on the <a href="http://mediatemple.net/webhosting/shared/" target="_blank"><?php echo $mediatemple_service_typename ?></a>.</p>

			<h3>Domain</h3>
			<?php

				echo '<strong>Primary Domain: </strong> <a href="' . $mediatemple_service_primarydomain .'" target="_blank">' . $mediatemple_service_primarydomain .'</a><br />';

				echo '<strong>Access Domain: </strong> <a href="' . $mediatemple_service_accessdomain .'" target="_blank">' . $mediatemple_service_accessdomain .'</a><br />';

				echo '<strong>Development URL: </strong> <a href="' . get_site_url() . '.' . $mediatemple_service_accessdomain .'" target="_blank">' . get_site_url() . '.' . $mediatemple_service_accessdomain . '</a><br />';



			?>


			<style>
			#mt-serviceinfo-dashboard-widget {
				background: #282b2d;
				color: #f6f6f6;
			}
			#mt-serviceinfo-dashboard-widget .hndle {
				background: #1c1c1e;
				color: #f6f6f6;
				border: none;
				padding: 10px 0 10px 10px;
				margin: 0;
			}
			#mt-serviceinfo-dashboard-widget h3 {
				background: #1c1c1e;
				color: #f6f6f6;
				margin: 5px 0;
				padding: 10px 0 10px 5px;
				border: none;
			}
			#mt-serviceinfo-dashboard-widget a {
				color: #67e5b3;
			}
			</style>





			<h3>DNS</h3>

			<strong>Primary Nameserver: </strong>ns1.mediatemple.net <br />
			<strong>Secondary Nameserver: </strong>ns2.mediatemple.net <br />
			<?php	echo '<strong>IP Addresses: </strong>' . join( ',', $mediatemple_service_ipAddresses ) .'<br />'; ?>

			<h3>Database</h3>

			<h3>Email</h3>

			<?php echo '<strong>Webmail Access: </strong> <a href="https://' . $mediatemple_service_accessdomain .'/.tools/webmail" target="_blank">https://' . $mediatemple_service_accessdomain .'/.tools/webmail</a><br /><br />'; ?>

			<strong><a href="http://mediatemple.net/help/mail/mailconfig/">Need to setup an email client?</a></strong>


			<h3>Server Details</h3>
				Site Root<br/>
				HTML Root<br/>
				CGI-BIN<br/>
				PHP (default on site):/usr/bin/php<br/>
				PHP4:/usr/bin/php4PHP5:/usr/bin/ <br/>
				php5Python:/usr/bin/pythonImageMagick:/usr/bin/convertphp.ini:/home/120871/etc/php.iniMySQL:/usr/bin/mysqlMySQL backups:/usr/bin/mysqldump

			<h3>Billing Information</h3>
			<?php
			echo '<strong>Billing Status: </strong>' . $mediatemple_service_billingStatusText .'<br />';

			if (  ! defined('WP_DEBUG') || defined('WP_DEBUG') && WP_DEBUG == true  ) {
			echo '<h3>Debug Info</h3>';
			echo '<strong>Billing Status (boolean): </strong>' . $mediatemple_service_billingStatus .'<br />';
			}
}


			echo '<strong>Service ID: </strong>' . $meditemple_service_id .'<br />';
			echo '<strong>Service Type: </strong>' . $mediatemple_servicetype .'<br />';
			echo '<strong>Operating System: </strong>' . $mediatemple_service_operatingSystem .'<br />';
			echo '<strong>Pending Reboot (Boolean): </strong>' . $mediatemple_service_pendingReboot .'<br />';
			}


			/* DV Items Only */
			if ($mediatemple_servicetype == '770') {
				echo '<strong>Operating System: </strong>' . $mediatemple_service_operatingSystemName .'<br />';
				echo '<strong>Host Server: </strong>' . $mediatemple_service_hostServer .'<br />';
			} // endif for DV

			/* GS Items Only */
			if ($mediatemple_servicetype == '396') {

				echo '<strong>PHP Info (Stable): </strong><a href="https://' . $mediatemple_service_accessdomain .'/gs-bin/phpinfo.php-stable" target="_blank">https://' . $mediatemple_service_accessdomain .'/gs-bin/phpinfo.php-stable</a> <br />';
				echo '<strong>PHP Info (Latest): </strong><a href="https://' . $mediatemple_service_accessdomain .'/gs-bin/phpinfo.php-latest" target="_blank">https://' . $mediatemple_service_accessdomain .'/gs-bin/phpinfo.php-latest</a> <br />';
				echo '<strong>SSH: </strong><a href="ssh://' . $mediatemple_service_accessdomain .'@'. $mediatemple_service_accessdomain .'">Quick Launch</a> <br />';
			} // endif for GS Fields
	}



// Load our Widget onto Dasboard
function mt_serviceinfo_dashboard_widget(){
	wp_add_dashboard_widget( 'mt-serviceinfo-dashboard-widget', '(mt) Media Temple - Service Details', 'mt_serviceinfo_output_dashboard_widget');
	}
add_action('wp_dashboard_setup', 'mt_serviceinfo_dashboard_widget');










################################################################################
// (mt) Media Temple Hosted By Footer
################################################################################
function mediatemple_footer_admin () {
  echo 'Hosted by <a href="http://www.mediatemple.net" target="_blank">(mt) Media Temple</a>. Powered by <a href="http://www.wordpress.org">WordPress</a>.';
}

add_filter('admin_footer_text', 'mediatemple_footer_admin');



################################################################################
// (mt) Media Temple DV Server Status Widget
################################################################################
add_action( 'wp_dashboard_setup', 'mtss_add_dashboard_widgets' );

// Display the Google Chart with (mt) server data on the dashboard
function mtss_dashboard_widget() {
	// Get the API Key from the database and make sure they exist
	$mediatemple_apikey = get_option( 'mediatemple_apikey' );
	$mediatemple_wp_this_service = get_option( 'mediatemple_wp_this_service' );

	if ( empty( $mediatemple_apikey ) OR empty( $mediatemple_wp_this_service ) ) {
		echo 'Your (mt) API key and/or service ID are not set. <a href="' . get_admin_url() . 'options-general.php?page=mediatemple">Enter them here!</a>';
		return;
	}

	// Get the results from the API
	$mt = json_decode( file_get_contents( 'https://api.mediatemple.net/api/v1/stats/' . $mediatemple_wp_this_service . '/1hour.json?apikey=' . $mediatemple_apikey ) );
	$range_stats = $mt->statsList;
	?>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	google.load('visualization', '1.0', {packages: ['corechart']});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Time');
		data.addColumn('number', 'CPU');
		data.addColumn('number', 'Memory');
		data.addColumn('number', 'Processes');
		data.addRows([
		<?php foreach ($range_stats->stats as $stat): ?>
			['<?php echo date('g:ia', $stat->timeStamp); ?>', <?php echo $stat->cpu / 100; ?>, <?php echo $stat->memory / 100; ?>, <?php echo $stat->processes / 100; ?>],
		<?php endforeach; ?>
		]);

		var options = {
			backgroundColor: '#f5f5f5',
			chartArea: {
				top: 20,
				right: 0,
				bottom: 0,
				left: 40,
			},
			colors: ['#21759B', '#D54E21', '#777777'],
			fontSize: '10',
			title: 'Last Hour',
			vAxis: {
				format: '#%'
			}
		};
		var chart = new google.visualization.LineChart(document.getElementById('mtss_chart'));
		var formatter = new google.visualization.NumberFormat({
			pattern: '#.##%',
			fractionDigits: 2
		});
		formatter.format(data, 1);
		formatter.format(data, 2);
		chart.draw(data, options);
	}
    </script>
    <div id="mtss_chart"></div>
	<?php
}

// Add the widget to the dashboard
function mtss_add_dashboard_widgets() {


	$mediatemple_apikey = get_option( 'mediatemple_apikey' );
	$mediatemple_wp_this_service = get_option( 'mediatemple_wp_this_service' );

	 // Headers for API Call
    $headers = array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
    );


	 $mediatemple_servicedetails_json = wp_remote_get( 'https://api.mediatemple.net/api/v1/services/' . $mediatemple_wp_this_service . '?apikey=' . $mediatemple_apikey,  array( 'sslverify' => true, 'headers' => $headers)  );

     // Decode Json
    $mediatemple_servicedetails = json_decode($mediatemple_servicedetails_json['body'], true);


    foreach($mediatemple_servicedetails as $mediatemple_servicedetail){

            $mediatemple_servicetype = $mediatemple_servicedetail['serviceType'];

}

// 770 | 796
if ( $mediatemple_servicetype != '796'  ) {
		return;
} else

	add_meta_box( 'mtss_dashboard_widget', '(mt) Media Temple - DV Server Status', 'mtss_dashboard_widget', 'dashboard', 'side', 'high' );
}
