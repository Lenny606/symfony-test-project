<?php

namespace App\Services;

use App\Enums\Reservations;

class ReservationsService
{
    public function getCalendarData(string $month, string $year): array
    {
        return $data = [
            'monthName' => Reservations::getMonthName($month, $year),
            'firstDay' => Reservations::getFirstDayOfMonth($month, $year),
            'daysOfWeek' => Reservations::getDaysOfWeek(),
            'currentDay' => Reservations::getCurrentDay(),
            'numberOfDays' => Reservations::numberOfDays($month, $year)
        ];
    }
}