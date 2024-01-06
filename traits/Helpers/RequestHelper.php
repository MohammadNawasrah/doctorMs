<?php

namespace Trait\Helpers;

class RequsetHelper
{
    protected static $response = [];
    public static function setResponse($status = 400, $message = "No Value", $toJson = true)
    {
        self::$response["status"] = $status;
        self::$response["message"] = $message;
        return $toJson ? json_encode(self::$response) : self::$response;
    }
    public static function addResponseData($key, $value)
    {
        self::$response[$key] = $value;
    }
    public static function getResponse($toJson = true)
    {
        return $toJson ? json_encode(self::$response) : self::$response;
    }
}
