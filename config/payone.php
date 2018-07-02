<?php

return [

	'server_api_url' => 'https://api.pay1.de/post-gateway/',

    "defaults" => [
        "aid"         => '40836', //"your_account_id",
        "mid"         => '40833', //Merchant account ID
        "portalid"    => '2029411', //Payment portal ID
        "key"         => hash("md5", "srXVvvoJCgQK5BM8"), //Payment portal key as MD5 value
        "mode"        => "test", // can be "live" for actual transactions
        "api_version" => "3.10", //Actual API-version (Default if not present)
        "encoding"    => "UTF-8",
    ],
];
