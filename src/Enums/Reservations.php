<?php

namespace App\Enums;

class Reservations
{
    const MONDAY = 'Monday';
    const TUESDAY = 'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY = 'Thursday';
    const FRIDAY = 'Friday';
    const SATURDAY = 'Saturday';
    const SUNDAY = 'Sunday';

    public static function getDaysOfWeek(): array
    {
        return [
            self::MONDAY,
            self::TUESDAY,
            self::WEDNESDAY,
            self::THURSDAY,
            self::FRIDAY,
            self::SATURDAY,
            self::SUNDAY,
        ];
    }

    public static function getFirstDayOfMonth($month, $year): int|bool
    {
        return mktime(0, 0, 0, $month, 1, $year);
    }

    public static function numberOfDays($month, $year): int|bool
    {
        $firstDayOfMonth = self::getFirstDayOfMonth($month, $year);
        return date("t", $firstDayOfMonth);
    }

    public static function dateComponent($month, $year): array
    {
        $firstDayOfMonth = self::getFirstDayOfMonth($month, $year);
        return getdate($firstDayOfMonth);
    }

    public static function getMonthName($month, $year): array
    {
        $data = self::dateComponent($month, $year);
        return $data['month'];
    }
    public static function getDayOfWeek($month, $year): array
    {
        $data = self::dateComponent($month, $year);
        return $data['wday'];
    }
    public static function getCurrentDay(): string
    {
        return date('Y-m-d');
    }


}