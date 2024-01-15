<?php
/*--------------------------------------------------------------
# JW Player - Iris Feed
--------------------------------------------------------------*/

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	/**
	 * echo jw_iris_feed();
	 */
	function jw_iris_feed() {

		# Total Videos
		$video_list = jw_api()->call( '/videos/list', array( 'result_limit' => '1' ) );
		$total_videos = $video_list['total'];

		# Limits and Paging
		## Divide by the result_limit and round up to the next whole number
		$result_limit = 1000;
		$pages = ceil( ( $total_videos / $result_limit ) );
		//WP_CLI::line( 'Pages: ' . $pages );

		# video_number
		//$video_number = 1;

		$potential_ticks = ( $result_limit * $pages );
		if ( $potential_ticks < $total_videos ) {
			$ticks = $potential_ticks;
		} else {
			$ticks = $total_videos;
		}
		$message = 'Processing JSON data for ' . WP_CLI::colorize( "%c$ticks%n" ) . ' videos';
		$notify = \WP_CLI\Utils\make_progress_bar( $message, $ticks );

		for ( $i = 0; $i < $pages; ++$i ) {
			$offset = ( $result_limit * $i );
			$videos = array();

			# Request the Data from JW
			$video_list_page = jw_api()->call( '/videos/list', array( 'result_limit' => $result_limit, 'result_offset' => $offset ) )['videos'];

			foreach ( $video_list_page as $video ) {
				$video_key = $video['key'];
				$url = 'content.jwplatform.com/videos/' . $video_key . '.mp4';
				$video['video_url'] = $url; // Insert the Video URL key/value pair into the array

				# Add a sequential video_number to track each video in the files for consistency
				//$video['video_number'] = $video_number; // Insert the Video URL key/value pair into the array
				//$video_number++;

				array_push( $videos, $video );
				$notify->tick();
			}
			$video_list['videos'] = $videos;
			$json = json_encode( $video_list, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );

			# Write the file
			$file_number = ($i + 1);
			$filename = 'iris_tv_jwplayer_data_' . $file_number . '.json';
			$file = fopen( $filename,'w+' );
			fwrite( $file, $json );
			fclose( $file );
			WP_CLI::line( $filename );
		}
		$notify->finish();

		//return $json;
		WP_CLI::success( 'Complete. ' . $pages . ' json files written:' );
	}
	WP_CLI::add_command( 'jwexport', 'jw_iris_feed' );
}
