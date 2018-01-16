<?php

abstract class WP_API_REST_Object {
	
	protected $client;

	protected function __construct( WP_API_REST_Client $client ) {
	    $this->client = $client;
	}

	public function get_client() {
		return $this->client;
	}
}