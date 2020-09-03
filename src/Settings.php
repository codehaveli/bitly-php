<?php

namespace Codehaveli;

use Codehaveli\Resources\{Link};

class Settings
{
    public const DEFAULT_SECONDS_TIMEOUT    = 90;
    public const API_VERSION                = "v4";

    public const BASE_URL                   = "api-ssl.bitly.com";
    public const API_URL                    = "https://" . self::BASE_URL;

    public const API_RESOURCES = [
        'link' => [
            'class' => Link::class
        ]
    ];

    public const DEFAULT_HEADERS = [
        'Content-Type'  => "application/json",
        "Host"          => self::BASE_URL,
    ];
}
