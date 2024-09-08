<?php

if (!function_exists('customTimeDiff')) {
    function customTimeDiff($dateTime)
    {
        $now = \Carbon\Carbon::now();
        $diff = $now->diff($dateTime);

        $diffInMinutes = $diff->days * 1440; // convert days to minutes
        $diffInMinutes += $diff->h * 60; // convert hours to minutes
        $diffInMinutes += $diff->i; // add minutes

        if ($diffInMinutes < 60) {
            return $diffInMinutes . 'm';
        } elseif ($diffInMinutes < 1440) { // 1440 minutes = 1 day
            return round($diffInMinutes / 60) . 'h';
        } else {
            return round($diffInMinutes / 1440) . 'd'; // 1440 minutes = 1 day
        }
    }
}
