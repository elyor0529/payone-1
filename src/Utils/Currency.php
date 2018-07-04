<?php

namespace Ideenkonzept\Payone\Utils;

class Currency
{
    const Euro             = "EUR";
    const AustralianDollar = "AUD";
    const SwissFranc       = "CHF";
    const DanishKrone      = "DKK";
    const PoundSterling    = "GBP";
    const NorwegianKrone   = "NOK";
    const NewZealandDollar = "NZD";
    const SwedishKrona     = "SEK";
    const USDollar         = "USD";

    public function getPaymentCurrency($currency)
    {
        return is_null($currency) ? config('payone.defaults.currency') : $currency;
    }
}
