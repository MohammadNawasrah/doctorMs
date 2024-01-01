<?php
// File: HttpStatusCodes.php

namespace Trait\Helpers;

class JsonHelper
{
    public static function getJsonKey($json)
    {
        return array_keys(json_decode(json_encode($json), true));
    }
}
