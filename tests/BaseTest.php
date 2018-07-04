<?php
/**
 * User: Ahmed Dabak
 * Date: 03.07.2018
 * Time: 15:44
 */

namespace Ideenkonzept\Payone\Tests;

use Ideenkonzept\Payone\PayoneFacade;
use Ideenkonzept\Payone\PayoneServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;


class BaseTest extends BaseTestCase {

	protected function getPackageProviders( $app ) {
		return [ PayoneServiceProvider::class ];
	}

	protected function getPackageAliases( $app ) {
		return [
			'Acme' => PayoneFacade::class
		];
	}

}