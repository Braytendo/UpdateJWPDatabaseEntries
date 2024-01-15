<?php
/*--------------------------------------------------------------
# JW Player/Platform API
--------------------------------------------------------------*/
function jw_api() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	return $botr_api;
}

/**
 * result_limit: Specifies maximum number of videos to return. Default is 50. Maximum result limit is 1000.
 */
function fcc_jw_api_list() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/list', array( 'result_limit' => '50', 'result_offset' => '0' ) );
	return $response;
}

/**
 * result_limit: Specifies maximum number of videos to return. Default is 50. Maximum result limit is 1000.
 */
function fcc_jw_api_list_with_url() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/list', array( 'result_limit' => '5', 'result_offset' => '0' ) );
	return $response;
}

function fcc_jw_api_build_url() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call_url( '/videos/list', null );
	return $response;
}

/**
 * JW Platform API: Return Video Object
 * Call the JW API to return the video based on the key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_key( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/show', array( 'video_key' => $key ) );
	return $response;
}

function fcc_jw_api_list_total() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/list', array( 'result_limit' => '1' ) );
	$response = $response['total'];
	return $response;
}

function fcc_jw_api_channels_list() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/channels/list', null );
	return $response;
}

function fcc_jw_api_accounts_show() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) ); // Instantiate the API.
	$response = $botr_api->call( '/accounts/show', null );
	return $response;
}

/**
 * JW Platform API: Query API Status
 * Call the JW API to return API status, use for key/secret verification.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.06.07
 */
function fcc_jw_api_check_status() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/status' );
	$status = $response['status'];
	if ( 'ok' == $status ) { $status = true; } else { $status = false; }
	return $status;
}

/**
 * Verify the API key and secret that the user has given, by making a call to
 * the API.
 *
 * If the credentials are invalid, return false.
 * If the API call failed, return NULL.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_account_verify_api_key_secret() {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/accounts/list' );
	if ( isset( $response ) && isset( $response['status'] ) ) {
		if ( 'ok' === $response['status'] ) {
			return true;
		}
		return false;
	}
	return null;
}

/**
 * JW Platform API: List Conversions
 * Returns an array of file conversions based on key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_list_conversions( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/conversions/list', array( 'video_key' => $key ) );
	return $response;
}

/**
 * JW Platform API: Return Video Object
 * Call the JW API to return the video based on the key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_video_status( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/show', array( 'video_key' => $key ) );
	$status = $response['status'];

	if ( 'ok' == $status ) {
		$status = true;
	} else {
		$status = false;
	}

	return $status;
}

/**
 * JW Platform API: Return Video Object
 * Call the JW API to return the video based on the key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_description( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/show', array( 'video_key' => $key ) );
	$description = $response['video']['description'];
	return $description;
}

/**
 * JW Platform API: Return Duration
 * Returns the duration of a video based on the player key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_duration( $key ) {

	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/show', array( 'video_key' => $key ) );
	$duration = $response['video']['duration'];

	if ( 0.00 != $duration ) {
		$duration = gmdate( 'H:i:s', round( $duration ) );
	}

	return $duration;
}

/**
 * JW Platform API: Return Duration from the 'Conversions' List
 * Returns the duration of a video based on the player key.
 * 11:57:48 | 00:12:05
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_conversion_duration( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/conversions/list', array( 'video_key' => $key ) );
	$total = $response['total']; # Total number of conversions

	if ( '2' == $total ) { # The 2nd array item should be the Audio conversion, grab that if present
		$duration = $response['conversions']['1']['duration'];
	} else { # If not, grab the original file
		$duration = $response['conversions']['0']['duration'];
	}
	$duration = gmdate( 'H:i:s', round( $duration ) );
	return $duration;
}

/**
 * JW Platform API: Return Size ( 'Length')
 * Returns the size of the file in bytes.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_size( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/conversions/list', array( 'video_key' => $key ) );
	$total = $response['total']; # Total number of conversions

	if ( '2' == $total ) { # The 2nd array item should be the Audio conversion, grab that if present
		$size = $response['conversions']['1']['filesize'];
	} else { # If not, grab the original file
		$size = $response['conversions']['0']['filesize'];
	}

	return $size;
}

/**
 * JW Platform API: Returns PubDate in original UNIX timestamp format
 * Format: Unix Timestamp
 * Returns the publish date of a video based on the player key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_date( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/show', array( 'video_key' => $key ) );
	$pubdate = $response['video']['date'];
	return $pubdate;
}

/**
 * JW Platform API: Return PubDate for iTunes RSS Feed
 * Format: Mon, 11 Jan 2016 16:09:00 +0000
 * Returns the publish date of a video based on the player key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_date_rss( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/show', array( 'video_key' => $key ) );
	$pubdate = $response['video']['date'];
	$pubdate = date( DATE_RFC2822, $pubdate );
	return $pubdate;
}

/**
 * JW Platform API: Return PubDate for admin dashboard display. (Human Friendly Format)
 * Format: Jan 11 2016, 4:09pm
 * Returns the publish date of a video based on the player key.
 * @author Ryan Veitch <ryan.veitch@forumcomm.com>
 * @version 1.16.05.26
 */
function fcc_jw_api_date_admin( $key ) {
	$botr_api = new BotrAPI( get_option( 'options_jw_platform_api_key' ), get_option( 'options_jw_platform_api_secret' ) );
	$response = $botr_api->call( '/videos/show', array( 'video_key' => $key ) ); // TODO: JW Admin Date - Add Success/Fail validation & AJAX support
	$pubdate = $response['video']['date'];
	$pubdate = date( 'M d Y, g:ia', $pubdate );
	return $pubdate;
}
