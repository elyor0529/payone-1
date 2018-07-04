<?php

namespace Ideenkonzept\Payone;

class Currency {
	const Euro = "EUR";
	const AustralianDollar = "AUD";
	const SwissFranc = "CHF";
	const DanishKrone = "DKK";
	const PoundSterling = "GBP";
	const NorwegianKrone = "NOK";
	const NewZealandDollar = "NZD";
	const SwedishKrona = "SEK";
	const USDollar = "USD";

	public static function default() {
		return config( 'payone.defaults.currency' );
	}
}
