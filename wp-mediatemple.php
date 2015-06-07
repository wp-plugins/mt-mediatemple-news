<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: (mt) Media Temple for WordPress
	Version: 1.1.1
	Plugin URI: https://brandonhubbard.com/mediatemple-news/
	Description: Keep up-to-date with (mt) Media Temple from within your Wordpress Blog.
	Author: Brandon Hubbard
	Author URI: https://www.brandonhubbard.com
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

include_once('mt-dashboard.php');

include_once('mt-adminbar.php');

include_once('mt-settings.php');

include_once('mt-optimizer.php');


################################################################################
// Plugin Activation
################################################################################

register_activation_hook( __FILE__, 'mediatemple_activate' );

function mediatemple_activate() {
    global $wpdb;

    // PLUGIN VERSION
    $mediatemple_version = '1.1.1';
    add_option( "mediatemple_version", $mediatemple_version );

}

################################################################################
// Uninstall
################################################################################
register_uninstall_hook('remove_mediatemple_plugin', 'mediatemple_uninstall');

// register_deactivation_hook( __FILE__, 'mediatemple_uninstall' );

function mediatemple_uninstall(){
    global $wpdb;

    delete_option( 'mediatemple_version' );
    delete_option( 'mediatemple_apikey' );
    delete_option( 'mediatemple_wp_this_service' );

}

