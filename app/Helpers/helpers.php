<?php

// if (!function_exists('customTimeDiff')) {
//     function customTimeDiff($dateTime)
//     {
//         // Parse the input into a Carbon instance
//         $dateTime = \Carbon\Carbon::parse($dateTime); 

//         // Get current time
//         $now = \Carbon\Carbon::now();

//         // Format the absolute date and time
//         $formattedDate = $dateTime->format('l j F Y \a\t H:i'); // Example: Thursday 3 October 2024 at 10:15

//         // Calculate the relative time difference
//         $diffForHumans = $dateTime->diffForHumans($now, ['parts' => 2]); // Example: "8 minutes ago"

//         // Return both formatted date and relative time
//         return $formattedDate . ' (' . $diffForHumans . ')';
//     }
// }


// if (!function_exists('customTimeDiff')) {
//     function customTimeDiff($dateTime)
//     {
//         // Parse the input date into a Carbon instance
//         $dateTime = \Carbon\Carbon::parse($dateTime);

//         // Get the current time
//         $now = \Carbon\Carbon::now();

//         // Format the exact date and time
//         $formattedDate = $dateTime->format('l j F Y \a\t H:i'); // e.g., "Sunday 29 September 2024 at 22:40"

//         // Check if it's more than 2 days ago for showing a human-readable difference
//         $diffInMinutes = $now->diffInMinutes($dateTime);
//         $diffInDays = $now->diffInDays($dateTime);

//         // Determine whether to return relative time or exact time with relative info
//         if ($diffInMinutes < 60) {
//             $relativeTime = $dateTime->diffForHumans($now, ['parts' => 1]); // e.g., "15 minutes ago"
//         } elseif ($diffInMinutes < 1440) {
//             $relativeTime = $dateTime->diffForHumans($now, ['parts' => 1]); // e.g., "5 hours ago"
//         } elseif ($diffInDays < 2) {
//             $relativeTime = 'Yesterday'; // e.g., "Yesterday"
//         } else {
//             $relativeTime = $dateTime->diffForHumans($now, ['parts' => 1]); // e.g., "3 days ago"
//         }

//         // Return both formatted date and relative time
//         return $formattedDate . ' (' . $relativeTime . ')';
//     }
// }

if (!function_exists('customTimeDiff')) {
    function customTimeDiff($dateTime)
    {
        // Parse the input date into a Carbon instance
        $dateTime = \Carbon\Carbon::parse($dateTime);

        // Get the current time
        $now = \Carbon\Carbon::now();

        // Format the exact date and time
        $formattedDate = $dateTime->format('l j F Y \a\t H:i'); // e.g., "Sunday 29 September 2024 at 22:40"

        // Check the difference in months
        $diffInMonths = $now->diffInMonths($dateTime);
        
        // Determine relative time
        $relativeTime = '';

        if ($diffInMonths < 1) {
            // Less than a month ago
            $diffInMinutes = $now->diffInMinutes($dateTime);
            if ($diffInMinutes < 60) {
                $relativeTime = $dateTime->diffForHumans($now, true) . ' ago'; // Ensure "ago" is added
            } elseif ($diffInMinutes < 1440) {
                $relativeTime = $dateTime->diffForHumans($now, true) . ' ago'; // Ensure "ago" is added
            } elseif ($diffInMinutes < 2880) { // Less than 2 days
                $relativeTime = 'Yesterday';
            } else {
                $relativeTime = $dateTime->diffForHumans($now, true) . ' ago'; // Ensure "ago" is added
            }
        }

        // Return either formatted date or relative time based on month difference
        return $diffInMonths >= 1 ? $formattedDate : $relativeTime;
    }
}

