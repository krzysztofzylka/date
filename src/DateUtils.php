<?php

namespace Krzysztofzylka\Date;

use DateTime;
use Exception;

/**
 * Date utils
 */
class DateUtils
{

    /**
     *  Calculates the total difference in months between two given dates.
     *
     *  This method computes the difference in months between a start date and an end date.
     *  It first determines the difference in years and months separately, and then combines these
     *  to give the total number of months difference. The result can be positive or negative,
     *  indicating whether the end date is after or before the start date, respectively.
     * @param string|Date $dateFrom
     * @param string|Date $dateTo
     * @return int
     * @throws Exception
     */
    public static function dateMonthDifference($dateFrom, $dateTo) : int {
        $dateFrom = $dateFrom instanceof Date ? $dateFrom->getDate('Y-m-d') : $dateFrom;
        $dateTo = $dateTo instanceof Date ? $dateTo->getDate('Y-m-d') : $dateTo;
        $dateFrom = new DateTime($dateFrom);
        $dateTo = new DateTime($dateTo);
        $yearsDiff = $dateTo->format('Y') - $dateFrom->format('Y');
        $monthsDiff = $dateTo->format('m') - $dateFrom->format('m');

        return $yearsDiff * 12 + $monthsDiff;
    }

    /**
     * Returns a string representation of the current date and time.
     * If the $microTime parameter is set to true, the method returns the current date and time
     * in microseconds. Otherwise, it returns the current date and time without microseconds.
     * @param bool $microTime (optional) Set to true to include microseconds in the result.
     * @return string The string representation of the current date and time.
     *     If $microTime is true, the format is 'Y-m-d H:i:s.u', otherwise 'Y-m-d H:i:s'.
     */
    public static function getSimpleDate(bool $microTime = false) : string {
        if ($microTime) {
            return DateTime::createFromFormat(
                'U.u',
                sprintf('%.f', microtime(true))
            )->format('Y-m-d H:i:s.u');
        }

        return date('Y-m-d H:i:s');
    }

    /**
     * Returns the number of seconds between the current time and the given date.
     * If the provided date is a Unix timestamp (integer), it calculates the difference between
     * the current time and the specified timestamp. If the provided date is a string, it converts
     * the string to a Unix timestamp using the strtotime() function and then calculates the difference.
     * @param string|int $date The date for which to calculate the time difference. It can be either
     * a Unix timestamp or a string that can be parsed with the strtotime() function.
     * @return int The number of seconds between the current time and the given date.
     */
    public static function getSecondsToDate($date) : int {
        return round(abs(time() - (is_int($date) ? $date : strtotime($date))));
    }

    /**
     * Calculates the difference between two dates and returns it as an associative array.
     *
     * @param mixed $date1 The first date.
     * @param mixed $date2 The second date.
     * @return array An associative array containing the difference with keys:
     *               - 'years' => (int) Number of years
     *               - 'months' => (int) Number of months
     *               - 'days' => (int) Number of days
     *               - 'hours' => (int) Number of hours
     *               - 'minutes' => (int) Number of minutes
     *               - 'seconds' => (int) Number of seconds
     *
     * @throws Exception If an invalid date string is provided.
     */
    public static function getDifference($date1, $date2): array
    {
        $date1 = (new DateTime())->setTimestamp(Date::create($date1)->getTime());
        $date2 = (new DateTime())->setTimestamp(Date::create($date2)->getTime());
        $interval = $date1->diff($date2);

        return [
            'years' => $interval->y,
            'months' => $interval->m,
            'days' => $interval->d,
            'hours' => $interval->h,
            'minutes' => $interval->i,
            'seconds' => $interval->s,
        ];
    }

}