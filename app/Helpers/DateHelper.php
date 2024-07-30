<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class DateHelper
{

    public static function getTimeago($datetimeString)
    {

        //2024-06-20 15:00:47
        $carbonDate = Carbon::parse($datetimeString);

        //2024-06-21 18:17:47
        $now = Carbon::now();
       
        $diff = $carbonDate->diff($now);

        $years = $diff->y;
        if ($years > 0) {
            return $years . (($years == 1) ? ' year' : ' years') . ' ago';
        }

        $months = $diff->m;
        if ($months > 0) {
            return $months . (($months == 1) ? ' month' : ' months') . ' ago';
        }

        $days = $diff->d;
        if ($days > 0) {
            return $days . (($days == 1) ? ' day' : ' days') . ' ago';
        }

        $hours = $diff->h;
        if ($hours > 0) {
            return $hours . (($hours == 1) ? ' hour' : ' hours') . ' ago';
        }

        $minutes = $diff->i;
        return $minutes . (($minutes == 1) ? ' minute' : ' minutes') . ' ago';
    }
}
