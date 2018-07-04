<?php
/**
 * User: Ahmed Dabak
 * Date: 03.07.2018
 * Time: 15:31
 */

namespace Ideenkonzept\Payone;

class PayoneBuilder {

	protected $parameters = [];
	private $client;

	public function __construct() {
		$this->client = new Client();
	}

	public function directDebit( $parameters ) {
		$this->mergeWithParameters( [
			'clearingtype' => 'elv'
		] );

		$this->mergeWithParameters( $parameters );

		return $this;
	}

	private function mergeWithParameters( $parameters ) {
		$this->parameters = array_merge( $this->parameters, $parameters );
	}

	public function creditCard( $card_type, $parameters ) {
		$this->mergeWithParameters( [
			'cardtype'     => $card_type,
			"clearingtype" => "cc"
		] );

		$this->mergeWithParameters( $parameters );

		return $this;
	}

	public function capture( $amount, $currency = null, $process_id, $sequence_number = null ) {
		$this->mergeWithParameters( [
			'request'  => 'capture',
			'txid'     => $process_id,
			'amount'   => $amount * 100,
			'currency' => $currency ?: Currency::default()
		] );

		if ( $sequence_number ) {
			$this->mergeWithParameters( [
				'sequencenumber' => $sequence_number
			] );
		}

		return $this->client->request( $this->parameters );
	}

	public function payDirect( $parameters ) {
		$this->mergeWithParameters( [
			"clearingtype" => "wlt",
			"wallettype"   => "PDT"
		] );

		$this->mergeWithParameters( $parameters );

		return $this;
	}

	public function customer( $customer ) {

		$this->mergeWithParameters( $customer );

		return $this;
	}

	public function authorize( $amount, $currency = null, $unique_id = null ) {

		$this->mergeWithParameters( [
			'request'   => 'authorization',
			'reference' => $unique_id ?: uniqid(),
			'amount'    => $amount * 100,
			'currency'  => $currency ?: Currency::default()
		] );

		return $this->client->request( $this->parameters );
	}

	public function preauthorize( $amount, $currency = null, $unique_id = null ) {
		$this->mergeWithParameters( [
			'request'   => 'preauthorization',
			'reference' => $unique_id ?: uniqid(),
			'amount'    => $amount * 100,
			'currency'  => $currency ?: Currency::default()
		] );

		return $this->client->request( $this->parameters );
	}

	public function refund( $amount, $currency = null, $process_id, $sequence_number ) {
		$this->mergeWithParameters( [
			'request'        => 'refund',
			'txid'           => $process_id,
			'sequencenumber' => $sequence_number,
			'amount'         => $amount * - 100,
			'currency'       => $currency ?: Currency::default()
		] );

		return $this->client->request( $this->parameters );
	}
}