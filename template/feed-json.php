<?php
/**
 * JSON Feed Template
 *
 * @since 1.16.06.07
 */
$callback = trim( esc_html( get_query_var( 'callback' ) ) );
$charset  = get_option( 'charset' );


$json = array();
$json = fcc_jw_api_list();

if ( $json ) {

	$json = json_encode( $json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );

	nocache_headers();
	if ( ! empty( $callback ) ) {
		header( "Content-Type: application/x-javascript; charset={$charset}" );
		echo "{$callback}({$json});";
	} else {
		header( "Content-Type: application/json; charset={$charset}" );
		echo $json;
	}
} else {
	status_header( '404' );
	wp_die( '404 Not Found' );
}
