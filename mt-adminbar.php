<?php

################################################################################
// Add mt Links to Admin Bar
################################################################################
function add_mt_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'mt_link',
	'title' => __( '<img src="'. plugins_url( 'assets/images/mt-logo-adminbar.png' , __FILE__ ) .'" class="mt-logo" alt="Media Temple" style="margin: 0 !important;padding-top:8px;" />'),
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

	// Add sub menu link "Call Support"
	$wp_admin_bar->add_menu( array(
		'parent' => 'mt_support',
		'id'     => 'mt_callsupport',
		'title' => __( 'Call 877.578.4000'),
		'href' => __('tel:8775784000'),
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


