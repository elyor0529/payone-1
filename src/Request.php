<?php

namespace Ideenkonzept\Payone;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Request
{
    /**
     * send a curl POST request to the PAYONE server API
     *
     * @param array $request
     * @throws Exception
     * @return array
     */
    public static function make($parameters)
    {
        $client = new Client();

        if ($response = $client->post(config('payone.api.url'), ['form_params' => $parameters])) {
            return self::parseResponse($response);
        }

        throw new ConnectionException('Connection Error', 0, $exception);
    }

    /**
     * gets response string an puts it into an array
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @throws Exception
     * @return array
     */
    public static function parseResponse(Response $response)
    {
        $result        = [];
        $keyValuePairs = explode("\n", $response->getBody());
        foreach ($keyValuePairs as $item) {
            $keyValuePair = explode('=', trim($item), 2);
            if (count($keyValuePair) == 2) {
                $result[trim($keyValuePair[0])] = trim($keyValuePair[1]);
            }

        }
        return $result;
    }

}
