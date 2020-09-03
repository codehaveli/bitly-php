<?php

namespace Codehaveli\Resources;

use Codehaveli\Exceptions\BitlyErrorException;
use Codehaveli\Exceptions\ResponseException;
use GuzzleHttp\Exception\RequestException;

class Link extends Resource
{
    private const CREATE_ENDPOINT = 'create';

    private const ENDPOINTS = [
        self::CREATE_ENDPOINT => "bitlinks",
    ];

    public function getUrl($long_url): string
    {

        $requestBody = ['long_url' => $long_url];

        try {
            $response = $this->getRequestor()->post(self::ENDPOINTS[self::CREATE_ENDPOINT], $requestBody);
        } catch (RequestException $clientException) {
            ResponseException::launch($clientException);
        }

        if ($response->getStatusCode() == 200) {
            $this->setData(json_decode($response->getBody()));
            $data = $this->getData();

            if (isset($data->link)) {
                return $data->link;
            }
        }

        throw new BitlyErrorException("The response does not contain a shortened link.");
    }
}
