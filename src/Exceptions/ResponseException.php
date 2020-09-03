<?php

namespace Codehaveli\Exceptions;

use GuzzleHttp\Exception\RequestException;

class ResponseException
{
    /**
     * @param ClientException $clientException
     * @param bool $logger
     * @return void
     * @throws BitlyErrorException
     */
    public static function launch(RequestException $clientException, bool $logger = true)
    {

        $error            = $clientException->getResponse();
        $rawResponse      = $error->getBody()->getContents();
        $errorPayload     = json_decode($rawResponse);
        $responseHttpCode = $clientException->getCode();
        $errorMessage     = isset($errorPayload->message) ? $errorPayload->message : '';

        if ($logger) {
            error_log("=========== ERROR ON Bitly API ===========");
            error_log("Type of error: {$responseHttpCode}");
            error_log("Description: {$errorMessage}");
            error_log("HTTP code: {$responseHttpCode}");
            error_log("Raw API response: {$rawResponse}");
            error_log("=========== // ERROR ON Bitly API // ===========");
        }


        if ($responseHttpCode === 403) {
            $errorMessage = "Invalid access token.";
            throw new BitlyErrorException("$errorMessage", $responseHttpCode, $clientException);
        }


        if (! in_array($responseHttpCode, [200 , 201])) {
             $errorMessage = "The API does not return a 200 or 201 status code. Response: " . $responseHttpCode;
             throw new BitlyErrorException("$errorMessage", $responseHttpCode, $clientException);
        }


        throw new BitlyErrorException("$errorMessage", $responseHttpCode, $clientException);
    }
}
