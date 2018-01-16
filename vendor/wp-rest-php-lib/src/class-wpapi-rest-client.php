<?php

class WPAPI_REST_Basic_Auth_Client extends WP_API_REST_Client {
	private $username;
	private $password;

	protected $request_methods = array(
		parent::REQUEST_METHOD_GET,
		parent::REQUEST_METHOD_POST,
		parent::REQUEST_METHOD_PUT,
		parent::REQUEST_METHOD_PATCH,
		parent::REQUEST_METHOD_HEAD,
		parent::REQUEST_METHOD_DELETE
	);

	public function __construct( $api_base_url, $username, $password ) {
		parent::__construct();
		$this->api_base_url = $api_base_url;
		$this->username = $username;
		$this->password = $password;
	}

	protected function authenticate_request( WP_API_REST_Request &$request ) {
		if ( $this->username && $this->password ) {
			$auth_string = sprintf( 'Basic %s', base64_encode( $this->username . ':' . $this->password ) );
			$request->add_header( 'Authorization', $auth_string );
		}
	}

	protected function send_request( WP_API_REST_Request $request ) {
		// WP-API expects data to be sent as JSON in the body of the request
		$post_data_json = json_encode( $request->get_post_data() );

		$request->add_header( 'Content-Type', 'application/json' );
		$request->add_header( 'Content-Length', strlen( $post_data_json ) );

		$request->set_post_data( $post_data_json );

		return parent::send_request( $request );
	}
}
