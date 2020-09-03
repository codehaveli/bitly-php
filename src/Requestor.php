<?php

namespace Codehaveli;

use GuzzleHttp\{Client, RequestOptions};
use Codehaveli\Exceptions\RequestException;
use Psr\Http\Message\ResponseInterface;
use Codehaveli\Settings;

class Requestor
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $request;

    /**
     * @var \StdClass
     */
    protected $response;


    /**
     * Requestor constructor.
     * @param array $apiUri
     * @param bool $production
     * @param string $authToken
     * @throws RequestException
     */
    public function __construct()
    {

        $this->client = new Client([
            'base_uri' => Settings::API_URL,
            'timeout'  => Settings::DEFAULT_SECONDS_TIMEOUT
        ]);
    }

    /**
     * @param string $resource
     * @param array $body
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(
        string $resource,
        array $body,
        array $headers = [],
        bool $hasVersion = true
    ): ResponseInterface {

        return $this->make(
            'POST',
            $resource,
            $body,
            $headers,
            [],
            $hasVersion
        );
    }

    /**
     * @param string $resource
     * @param array $query
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(
        string $resource,
        array $query,
        array $headers = [],
        bool $hasVersion = true
    ): ResponseInterface {
        return $this->make(
            'GET',
            $resource,
            [],
            $headers,
            $query,
            $hasVersion
        );
    }

    /**
     * Make a request with Guzzle
     * @param string $type
     * @param string $resource
     * @param array $body
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function make(
        string $type,
        string $resource,
        array $body,
        array $headers,
        array $query = [],
        bool $hasVersion = true
    ): ResponseInterface {
        $mergedHeaders = self::mergeHeaders(array_merge($headers, [
            'Authorization' => "Bearer " . Bitly::getAccessToken() // Get Access Token
        ]));

        $resourcePath = [
            Settings::API_VERSION,
            $resource
        ];

        if (!$hasVersion) {
            array_shift($resourcePath);
        }
 
        return $this->client->request($type, implode('/', $resourcePath), [
            RequestOptions::HEADERS => $mergedHeaders,
            RequestOptions::JSON => $body,
            RequestOptions::QUERY => $query,
        ]);
    }

    /**
     * @param array $headers
     * @return array
     */
    public static function mergeHeaders(array $headers): array
    {
        return array_merge(Settings::DEFAULT_HEADERS, $headers);
    }
}
