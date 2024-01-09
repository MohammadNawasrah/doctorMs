<?php

namespace Trait\Helpers;

use Carbon\Carbon;
use DateTime;

use function GuzzleHttp\json_encode;

class DateHelper
{
    public static function isDateTodayOrInFuture($dateString)
    {
        $carbonDatetime = self::convertToUTC($dateString);
        $currentDateTime = Carbon::now();
        $dateComparison = $carbonDatetime->isAfter($currentDateTime->toDateString());
        $timeComparison = $carbonDatetime->isAfter($currentDateTime->toTimeString());
        return $dateComparison && $timeComparison;
    }
    static function  convertToUTC($dateString)
    {
        $carbonDatetime = Carbon::parse($dateString, 'Asia/Amman');
        $carbonUtc = $carbonDatetime->setTimezone('UTC');
        return $carbonUtc;
    }
}
