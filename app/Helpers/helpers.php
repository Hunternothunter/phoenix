<?php

if (!function_exists('customTimeDiff')) {
    function customTimeDiff($dateTime)
    {
        $now = \Carbon\Carbon::now();
        $diff = $now->diff($dateTime);

        // Calculate total difference in minutes
        $diffInMinutes = ($diff->days * 1440) + ($diff->h * 60) + $diff->i;
        
        // Handle seconds
        $diffInSeconds = $diff->s;

        // Return the appropriate format
        if ($diffInMinutes < 1) {
            return $diffInSeconds . 's'; // Less than a minute, return seconds
        } elseif ($diffInMinutes < 60) {
            return $diffInMinutes . 'm'; // Less than an hour, return minutes
        } elseif ($diffInMinutes < 1440) { // Less than a day, return hours
            return round($diffInMinutes / 60) . 'h';
        } else { // More than a day, return days
            return round($diffInMinutes / 1440) . 'd';
        }
    }
}

