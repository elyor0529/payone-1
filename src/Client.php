<?php
/**
 * User: Ahmed Dabak
 * Date: 03.07.2018
 * Time: 15:31
 */

namespace Ideenkonzept\Payone;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ConnectException;
use Psr\Http\Message\ResponseInterface;

class Client {
	/**
	 * @var Guzzle
	 */
	private $client;

	public function __construct() {

		$this->client = new Guzzle( [ 'verify' => false ] );
	}


	public function request( $parameters ) {

		$parameters = $this->prepareParameters( $parameters );

		try {
			$response = $this->client->post( config( 'payone.api.url' ), [ 'form_params' => $parameters ] );

			return $this->respond( $response );
		} catch ( ConnectException $request_exception ) {
			die( 'A networking error prevented the request from completing: ' . $request_exception->getMessage() );
		}
	}

	private function prepareParameters( $parameters ) {
		return array_merge( $parameters, config( 'payone.credentials' ) );
	}

	private static function respond( ResponseInterface $response ) {
		$result         = [];
		$response_lines = explode( "\n", $response->getBody() );
		foreach ( $response_lines as $line ) {
			$key_value = explode( '=', trim( $line ), 2 );;
			if ( count( $key_value ) == 2 && list( $key, $value ) = $key_value ) {
				$result[ trim( $key ) ] = trim( $value );
			}
		}

		return $result;
	}
}
