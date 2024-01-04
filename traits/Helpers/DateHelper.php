<?php

namespace Trait\Helpers;

use DateTime;

use function GuzzleHttp\json_encode;

class DateHelper
{
    public static function isDateTodayOrInFuture($dateString)
    {

        $inputDate = new DateTime($dateString);
        $currentDate = new DateTime();
        return $inputDate >= $currentDate;
    }
}
