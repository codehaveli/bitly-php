<?php

namespace Codehaveli;

use Codehaveli\Exceptions\RequestException;
use Codehaveli\Resources\Resource;

class Bitly
{
    /**
     * Bitly Group GUID
     * @var string
     */
    private static $group_guid;

    /**
     * Bitly access token
     * @var string
     */
    private static $access_token;

    /**
     * Bitly Domain
     * @var string
     * Default is
     */
    private static $domain;

    /**
     * Set a credentials and environment for Codehaveli API
     * @return void
     * @throws \Exception
     */
    public static function init(string $access_token, string $group_guid, string $domain = "bit.ly")
    {
        self::$access_token = $access_token;
        self::$group_guid = $group_guid;
        self::$domain = $domain;
    }

    /**
     * Generate string of authenticate
     * @return string
     * @throws \Exception
     */
    public static function getAccessToken(): string
    {
        if (empty(self::$access_token)) {
            throw new RequestException("Missing Bitly API key or code, ensure that execute init method.");
        }
        return self::$access_token;
    }

    /**
     * Make a new instance on resource requested
     * @param string $name
     * @param array $arguments
     * @return Resource New instance of Codehaveli api resource
     * @throws Exceptions\RequestException
     */
    public static function __callStatic(string $name, array $arguments): Resource
    {
        if (!key_exists($name, Settings::API_RESOURCES)) {
            throw new RequestException("Undefined resource {$name} to access.");
        }

        $resourceClass = Settings::API_RESOURCES[$name]['class'];

        return new $resourceClass(new Requestor());
    }
}
