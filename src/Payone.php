<?php

namespace Ideenkonzept\Payone;

class Payone
{
    private $parameters = [];

    public function directDiebt($amount, $currency)
    {
        $this->parameters = array_merge($this->parameters, [
            'amount'       => $amount * 100,
            'currency'     => $currency,
            "request"      => "authorization",
            "clearingtype" => "elv",
        ]);

        return Request::make($this->getAllParameters());
    }

    public function from($customer)
    {
        $this->parameters = array_merge($this->parameters, $customer);
        return $this;
    }

    private function getAllParameters()
    {
        return array_merge(
            $this->parameters,
            ['reference' => uniqid()],
            config('payone.defaults')
        );
    }

    public function payDirect($amount, $currency)
    {
        $this->parameters = array_merge($this->parameters, [
            'amount'                                                   => $amount * 100,
            'currency'                                                 => $currency,
            "request"                                                  => "authorization",
            "clearingtype"                                             => "wlt",
            "wallettype"                                               => "PDT",
            "narrative_text"                                           => "Just an order",
            "successurl"                                               => "https://yourshop.de/payment/success?reference=your_unique_reference",
            "errorurl"                                                 => "https://yourshop.de/payment/error?reference=your_unique_reference",
            "backurl"                                                  => "https://yourshop.de/payment/back?reference=your_unique_reference",
            /**
             * These are specific Paydirekt parameters. Paydirekt can verify the age of the customer.
             * If it's below the add_paydata[minimum_age], the payment will be refused and the customer
             * will be redirected to the URL defined in add_paydata[redirect_url_after_age_verification_failure]
             */
            "add_paydata[minimum_age]"                                 => "18",
            "add_paydata[redirect_url_after_age_verification_failure]" => "https://yourshop.de/payment/tooyoung",
        ]);

        return Request::make($this->getAllParameters());
    }


    public function creditCard($amount , $currency)
    {
        $this->parameters = array_merge($this->parameters, [
            'amount'                                                   => $amount * 100,
            'currency'                                                 => $currency,
            "request"                                                  => "authorization",
            "clearingtype"                                             => "cc"
        ]);

        return Request::make($this->getAllParameters());
    }


}
