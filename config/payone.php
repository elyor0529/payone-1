<?php

use Ideenkonzept\Payone\Currency;

return [

	'api' => [
		'url' => env( 'PAYONE_SERVER_URL', 'https://api.pay1.de/post-gateway/' ),
	],

	'defaults' => [
		'currency' => Currency::Euro
	],

	'credentials' => [
		'aid'      => env( 'PAYONE_ACCOUNT_ID' ),
		'mid'      => env( 'PAYONE_MERCHANT_ACCOUNT_ID' ),
		'portalid' => env( 'PAYONE_PORTAL_ID' ),
		'key'      => hash( 'md5', env( 'PAYONE_KEY' ) ),
		'mode'     => env( 'PAYONE_MODE', 'test' ),
		'encoding' => env( 'PAYONE_encoding', 'UTF-8' ),
		'version'  => env( 'PAYONE_API_VERSION', '3.10' )
	],
];
