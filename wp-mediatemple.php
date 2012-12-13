<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: (mt) Media Temple News
	Version: 1.0.0
	Plugin URI: https://github.com/bhubbard/mediatemple-news
	Description: Keep up-to-date with (mt) Media Temple from within your Wordpress Blog.
	Author: Brandon Hubbard
	Author URI: http://www.brandonhubbard.com
	License: GNU General Public License version 3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

-----------------------------------------------------------------------------------*/


################################################################################
// (mt) Media Temple KnowledgeBase Widget
################################################################################
function mtknowledgebase_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', '(mt) MediaTemple KnowledgeBase', 'custom_dashboard_help');
}

function custom_dashboard_help() {
?>
		  <form style="display: inline;" method="get" action="http://kb.mediatemple.net/search.php">
				<input name="Query" type="text" placeholder="Enter Keywords" />
				<input type="submit" class="button" value="Search"  />
		  </form>

<?php
}

add_action('wp_dashboard_setup', 'mtknowledgebase_dashboard_widgets');

################################################################################
// (mt) Media Temple Blog Widget
################################################################################
function mtblog_rss_output(){
       wp_widget_rss_output(array(
            'url' => 'http://weblog.mediatemple.net/feed/', 
            'title' => 'Latest News from (mt) MediaTemple', 
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
  wp_add_dashboard_widget( 'mtblog-rss', 'Latest News from (mt) MediaTemple', 'mtblog_rss_output');
}

################################################################################
// (mt) Media Temple System Status Incidents Dashboard Widget
################################################################################
function mt_systemstatus_dashboard_widget(){
	echo '<h4 style="font-weight:bold;">Last 3 known Incidents</h4>';
		wp_widget_rss_output(array(
            'url' => 'http://status.mediatemple.net/feed?post_type=incidents',  //put your feed URL here
            'title' => '(mt) Media Temple System Status - Last 3 Incidents',
            'items' => 3, 
            'show_summary' => 0, // 0 = false and 1 = true 
            'show_author' => 0,
            'show_date' => 1
        ));      
        echo '<h4 style="font-weight:bold;">Last 3 known Maintenance Periods</h4>';
        	wp_widget_rss_output(array(
            'url' => 'http://status.mediatemple.net/feed/?post_type=maintenances',  //put your feed URL here
            'title' => '(mt) Media Temple System Status - Last 3 Incidents',
            'items' => 3, 
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
// (mt) Media Temple Twitter Dashboard Widget
################################################################################
function mt_twitter_dashboard_widget(){
		wp_widget_rss_output(array(
            'url' => 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=mediatemple',  //put your feed URL here
            'title' => 'Tweets from mt', // Your feed title
            'items' => 3, //how many posts to show
            'show_summary' => 0, // 0 = false and 1 = true 
            'show_author' => 0,
            'show_date' => 'y'
        ));      
	}

// Load our Widget onto Dasboard
function load_mt_twitter_dashboard_widget(){
	wp_add_dashboard_widget( 'mt-twitter-dashboard-widget', 'Tweets from (mt) Media Temple', 'mt_twitter_dashboard_widget');
	}
add_action('wp_dashboard_setup', 'load_mt_twitter_dashboard_widget');

################################################################################
// Add mt Links to Admin Bar 
################################################################################
function add_mt_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'mt_link',
	'title' => __( '(mt) MediaTemple'),
	'href' => __('http://mediatemple.net'),
	"meta" => array("target" => "blank")
	));

	// Add sub menu link "AccountCenter"
	$wp_admin_bar->add_menu( array(
		'parent' => 'mt_link',
		'id'     => 'mt_accountcenter',
		'title' => __( 'AccountCenter'),
		'href' => __('https://ac.mediatemple.net'),
		"meta" => array("target" => "blank")
	));
	
	// Add sub menu link "Connect"
	$wp_admin_bar->add_menu( array(
		'parent' => 'mt_link',
		'id'     => 'mt_social',
		'title' => __( 'Connect with (mt)'),
		'meta'   => array(
			'class' => 'imfza_menu_social',),
			"meta" => array("target" => "blank")
	));
		// Facebook
		$wp_admin_bar->add_menu( array(
			'parent' => 'mt_social',
			'id'     => 'mt_facebook',
			'title' => __( 'Facebook'),
			'href' => __('https://www.facebook.com/mediatemple'),
			"meta" => array("target" => "blank")
		));
		// Twitter
		$wp_admin_bar->add_menu( array(
			'parent' => 'mt_social',
			'id'     => 'mt_twitter',
			'title' => __( 'Twitter'),
			'href' => __('http://twitter.com/mediatemple'),
			"meta" => array("target" => "blank")
		));
		// Pinterest
		$wp_admin_bar->add_menu( array(
			'parent' => 'mt_social',
			'id'     => 'mt_pinterest',
			'title' => __( 'Pinterest'),
			'href' => __('http://pinterest.com/mediatemple'),
			"meta" => array("target" => "blank")
		));
		// Instagram
		$wp_admin_bar->add_menu( array(
			'parent' => 'mt_social',
			'id'     => 'mt_instagram',
			'title' => __( 'Instagram'),
			'href' => __('http://instagram.com/mediatemple'),
			"meta" => array("target" => "blank")
		));
	
	// Add sub menu link "Support"
	$wp_admin_bar->add_menu( array(
		'parent' => 'mt_link',
		'id'     => 'mt_support',
		'title' => __( 'Support'),
		'href' => __('http://mediatemple.net/help/'),
		"meta" => array("target" => "blank")
	));
	
	// Add sub menu link "System Status"
	$wp_admin_bar->add_menu( array(
		'parent' => 'mt_support',
		'id'     => 'mt_systemstatus',
		'title' => __( 'System Status'),
		'href' => __('http://status.mediatemple.net/'),
		"meta" => array("target" => "blank")
	));

	// Add sub menu link "Knowledgebase"
	$wp_admin_bar->add_menu( array(
		'parent' => 'mt_support',
		'id'     => 'mt_knowledgebase',
		'title' => __( 'KnowledgeBase'),
		'href' => __('http://kb.mediatemple.net/'),
		"meta" => array("target" => "blank")
	));
	// Add sub menu link "Forums"
	$wp_admin_bar->add_menu( array(
		'parent' => 'mt_support',
		'id'     => 'mt_forums',
		'title' => __( 'Community Forums'),
		'href' => __('https://forum.mediatemple.net/'),
		"meta" => array("target" => "blank")
	));
}
add_action('admin_bar_menu', 'add_mt_admin_bar_link',25);