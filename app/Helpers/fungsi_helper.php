<?php

function convertToIndonesianTime($datetime)
{
    // Create a DateTime object from the input datetime
    $indonesiaDateTime = new DateTime($datetime, new DateTimeZone('Asia/Jakarta'));

    // Convert to the desired timezone (Indonesia/Jakarta)
    // $indonesiaTimeZone = new DateTimeZone('Asia/Jakarta');
    // $indonesiaDateTime = $utcDateTime->setTimezone($indonesiaTimeZone);

    // Format the datetime as "d F Y H:i:s" (e.g., "30 Juli 2024 20:14:00")
    $formattedDateTime = $indonesiaDateTime->format('l, d F Y H:i:s');

    return $formattedDateTime;
}
