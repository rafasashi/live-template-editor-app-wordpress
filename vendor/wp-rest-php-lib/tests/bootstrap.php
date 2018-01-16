<?php

$config_file = dirname( __FILE__ ) . '/config.php';
if ( is_readable( $config_file ) ) {
	require( $config_file );
}
unset( $config_file );

require( dirname( dirname( __FILE__ ) ) . '/src/wpcom.php' );

class WPCOM_REST_Transport_Mock extends WPCOM_REST_Transport {
	public function send_request( WPCOM_REST_Request $request ) {
	}
}
