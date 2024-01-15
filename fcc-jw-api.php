<?php
/**
 * Plugin Name: FCC JW API
 * Description: JW Player API Test functions, feeds, and WP-CLI commands.
 * Plugin URI:  https://github.com/openfcci/fcc-jw-api
 * Author:      Forum Communications Company, Ryan Veitch
 * Author URI:  http://www.forumcomm.com/
 * License:     GPL v2 or later
 * Version:     1.07.11.16
 */

# https://developer.jwplayer.com/jw-platform/reference/v1/methods/videos/list.html

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/*--------------------------------------------------------------
# PLUGIN ACTIVATION/DEACTIVATION HOOKS
--------------------------------------------------------------*/

/**
 * Plugin Activation Hook
 */
function fcc_jw_api_plugin_activation() {
	flush_rewrite_rules(); // Flush our rewrite rules on activation.
}
register_activation_hook( __FILE__, 'fcc_jw_api_plugin_activation' );

/**
 * Plugin Deactivation Hook
 */
function fcc_jw_api_plugin_deactivation() {
	flush_rewrite_rules(); // Flush our rewrite rules on deactivation.
}
register_deactivation_hook( __FILE__, 'fcc_jw_api_plugin_deactivation' );

/*--------------------------------------------------------------
# LOAD INCLUDES FILES
--------------------------------------------------------------*/

# JW Platform/BOTR API
if ( ! class_exists( 'BotrAPI' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/botr/api.php' );
}

# JW Platform/Player API Functions
require_once( plugin_dir_path( __FILE__ ) . '/includes/jw-api.php' );

# IRIS.TV Feed Function
require_once( plugin_dir_path( __FILE__ ) . '/includes/jw-iris.php' );

/*--------------------------------------------------------------
# JSON FEED
--------------------------------------------------------------*/

/**
 * Add 'sites' JSON Feed
 *
 * @since 1.16.06.07
 * @version 1.16.06.07
 */
function fcc_jw_api_do_json_feed() {
	add_feed( 'jw', 'add_jw_list_feed' );
}
add_action( 'init', 'fcc_jw_api_do_json_feed' );

/**
 * Load JSON Feed Template
 *
 * @since 1.16.06.07
 * @version 1.16.06.07
 */
function add_jw_list_feed() {
	load_template( plugin_dir_path( __FILE__ ) . 'template/feed-json.php' );
}
