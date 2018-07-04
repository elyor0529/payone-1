<?php
/**
 * User: Ahmed Dabak
 * Date: 03.07.2018
 * Time: 15:54
 */

namespace Ideenkonzept\Payone\Tests;


use Ideenkonzept\Payone\Client;

class ClientTests extends BaseTest {
	private $client;

	/** @test */
	public function it_can_make_direct_debit_authorization_requests() {
		$response = $this->client->request( [
			'firstname'       => 'John',
			'lastname'        => 'Snow',
			'amount'          => 1000,
			'currency'        => 'EUR',
			'street'          => 'Black Castel',
			'zip'             => '00110',
			'city'            => 'Winterfell',
			'country'         => 'DE',
			'email'           => 'john@winterfell.north',
			'telephonenumber' => '2233665588',
			'iban'            => 'DE85123456782599100003',
			'bic'             => 'TESTTEST',
			'request'         => 'authorization',
			'clearingtype'    => 'elv',
			'reference'       => uniqid()
		] );

		$this->assertInternalType( 'array', $response );
		$this->assertArraySubset( [ 'status' => 'APPROVED' ], $response );
	}

	/**
	 * Setup the test environment.
	 */
	protected function setUp(): void {
		parent::setUp();
		$this->client = new Client();
	}
}