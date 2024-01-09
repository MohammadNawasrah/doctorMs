<?php
// File: HttpStatusCodes.php

namespace Trait\Helpers;


class UtileHelper
{
    public static function checkIfDataEmptyOrNull($data)
    {
        try {

            if (empty($data)) {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "$data empty"));
            }
            if (($data) == null) {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "$data null"));
            }
            if ($data == "") {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "$data empty"));
            }
            if (($data) == "null") {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "$data null"));
            }
            if (($data) == "Null") {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "$data null"));
            }
            if (($data) == Null) {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "$data null"));
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th));
        }
    }
    public static function checkIfDataEmptyOrNullArrayData($arrayData)
    {
        try {
            foreach ($arrayData as $value) {
                self::checkIfDataEmptyOrNull($value);
            }
        } catch (\Throwable $th) {
        }
    }
    public static function checkIfDataEmptyOrNullJsonData($jsonData)
    {
        try {
            foreach ($jsonData as $key => $value) {
                self::checkIfDataEmptyOrNull($key);
                self::checkIfDataEmptyOrNull($value);
            }
        } catch (\Throwable $th) {
        }
    }
}
