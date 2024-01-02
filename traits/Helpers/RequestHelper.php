<?php

namespace Trait\Helpers;

class RequsetHelper
{
    protected static $response = [];
    public static function setResponse($status = 400, $message = "No Value")
    {
        self::$response["status"] = $status;
        self::$response["message"] = $message;
        return self::$response;
    }
    public static function addResponseData($key, $value)
    {
        self::$response[$key] = $value;
    }
    public static function getResponse()
    {
        return self::$response;
    }
    public static function addArrayData($keys, $values)
    {
        // Check if the count of keys is equal to the count of values
        if (count($keys) !== count($values)) {
            // You may want to handle this error in a way that fits your application
            return self::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Key count does not match value count");
        }

        // Combine keys and values into an associative array
        $data = array_combine($keys, $values);

        // Merge the new data with the existing response
        self::$response = array_merge(self::$response, $data);

        return self::$response;
    }
}
