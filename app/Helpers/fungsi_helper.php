<?php

use CodeIgniter\I18n\Time;

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

function datetimeToBahasa($datetime)
{
    $time = Time::parse($datetime);

    $days = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $months = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    $dayName = $days[$time->format('l')];
    $monthName = $months[$time->format('F')];

    return $dayName . ', ' . $time->format('d') . ' ' . $monthName . ' ' . $time->format('Y H:i:s');
}
