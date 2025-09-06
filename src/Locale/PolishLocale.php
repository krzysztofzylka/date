<?php

namespace Krzysztofzylka\Date\Locale;

/**
 * Polish locale constants for dates
 */
class PolishLocale
{

    public const array MONTHS_SHORT = [
        1 => 'Sty',
        2 => 'Lut',
        3 => 'Mar',
        4 => 'Kwi',
        5 => 'Maj',
        6 => 'Cze',
        7 => 'Lip',
        8 => 'Sie',
        9 => 'Wrz',
        10 => 'Paź',
        11 => 'Lis',
        12 => 'Gru'
    ];

    public const array MONTHS_LONG = [
        1 => 'Styczeń',
        2 => 'Luty',
        3 => 'Marzec',
        4 => 'Kwiecień',
        5 => 'Maj',
        6 => 'Czerwiec',
        7 => 'Lipiec',
        8 => 'Sierpień',
        9 => 'Wrzesień',
        10 => 'Październik',
        11 => 'Listopad',
        12 => 'Grudzień'
    ];

    public const array WEEKDAYS_SHORT = [
        2 => 'Pon',
        3 => 'Wto',
        4 => 'Śro',
        5 => 'Czw',
        6 => 'Pią',
        0 => 'Sob',
        1 => 'Nie'
    ];

    public const array WEEKDAYS_LONG = [
        2 => 'Poniedziałek',
        3 => 'Wtorek',
        4 => 'Środa',
        5 => 'Czwartek',
        6 => 'Piątek',
        0 => 'Sobota',
        1 => 'Niedziela'
    ];

    public const array WEEKDAYS_SHORT_MONDAY_ZERO = [
        0 => 'Pon',
        1 => 'Wto',
        2 => 'Śro',
        3 => 'Czw',
        4 => 'Pią',
        5 => 'Sob',
        6 => 'Nie'
    ];

    public const array WEEKDAYS_LONG_MONDAY_ZERO = [
        0 => 'Poniedziałek',
        1 => 'Wtorek',
        2 => 'Środa',
        3 => 'Czwartek',
        4 => 'Piątek',
        5 => 'Sobota',
        6 => 'Niedziela'
    ];

    /**
     * Get Polish month name
     * @param int $month Month number (1-12)
     * @param bool $short Return short version
     * @return string Polish month name
     */
    public static function getMonthName(int $month, bool $short = false): string
    {
        $names = $short ? self::MONTHS_SHORT : self::MONTHS_LONG;
        
        return $names[$month] ?? '';
    }

    /**
     * Get Polish day name (Sunday = 0 convention)
     * @param int $dayOfWeek Day of week (0=Sunday, 1=Monday, etc.)
     * @param bool $short Return short version
     * @return string Polish day name
     */
    public static function getDayName(int $dayOfWeek, bool $short = false): string
    {
        $names = $short ? self::WEEKDAYS_SHORT : self::WEEKDAYS_LONG;
        
        return $names[$dayOfWeek] ?? '';
    }

    /**
     * Get Polish day name (Monday = 0 convention)
     * @param int $dayOfWeek Day of week (0=Monday, 1=Tuesday, etc.)
     * @param bool $short Return short version
     * @return string Polish day name
     */
    public static function getDayNameMondayZero(int $dayOfWeek, bool $short = false): string
    {
        $names = $short ? self::WEEKDAYS_SHORT_MONDAY_ZERO : self::WEEKDAYS_LONG_MONDAY_ZERO;
        
        return $names[$dayOfWeek] ?? '';
    }

    /**
     * Convert day number from Sunday=0 to Monday=0 convention
     * @param int $dayOfWeek Day of week in Sunday=0 format (0=Sunday, 1=Monday, etc.)
     * @return int Day of week in Monday=0 format (0=Monday, 1=Tuesday, etc.)
     */
    public static function convertSundayZeroToMondayZero(int $dayOfWeek): int
    {
        return $dayOfWeek === 0 ? 6 : $dayOfWeek - 1;
    }

    /**
     * Convert day number from Monday=0 to Sunday=0 convention
     * @param int $dayOfWeek Day of week in Monday=0 format (0=Monday, 1=Tuesday, etc.)
     * @return int Day of week in Sunday=0 format (0=Sunday, 1=Monday, etc.)
     */
    public static function convertMondayZeroToSundayZero(int $dayOfWeek): int
    {
        return $dayOfWeek === 6 ? 0 : $dayOfWeek + 1;
    }

}
