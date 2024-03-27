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
     * @param string $dateFrom
     * @param string $dateTo
     * @return int
     * @throws Exception
     */
    public static function dateMonthDifference(string $dateFrom, string $dateTo) : int {
        $dateFrom = new DateTime($dateFrom);
        $dateTo = new DateTime($dateTo);
        $yearsDiff = $dateTo->format('Y') - $dateFrom->format('Y');
        $monthsDiff = $dateTo->format('m') - $dateFrom->format('m');

        return $yearsDiff * 12 + $monthsDiff;
    }

}