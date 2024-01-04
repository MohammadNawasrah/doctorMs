<?php

namespace Trait\Helpers;

class RequsetHelper
{
    protected static $response = [];
    public static function setResponse($status = 400, $message = "No Value")
    {
        self::$response["status"] = $status;
        self::$response["message"] = $message;
        return json_encode(self::$response);
    }
    public static function addResponseData($key, $value)
    {
        self::$response[$key] = $value;
    }
    public static function getResponse()
    {
        return json_encode(self::$response);
    }
}
