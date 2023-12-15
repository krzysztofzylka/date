<?php

namespace Krzysztofzylka\Date;

use DateTime;

/**
 * Operating on date
 * @package Biblioteki
 */
class Date
{

    /**
     * Seconds in month (30 day)
     * @var int
     */
    public static int $MONTH = 2592000;

    /**
     * Seconds in day
     * @var int
     */
    public static int $DAY = 86400;

    /**
     * Seconds in hour
     * @var int
     */
    public static int $HOUR = 3600;

    /**
     * Seconds in minute
     * @var int
     */
    public static int $MINUTE = 60;

    /**
     * Timestamp
     * @var int
     * @ignore
     */
    protected int $time;

    /**
     * Date format
     * @var ?string
     * @ignore
     */
    public static ?string $format = 'Y-m-d H:i:s';

    /**
     * Constructor for the class.
     * @param mixed $date Optional. The initial date value, defaults to null.
     * @return void
     */
    public function __construct(mixed $date = null)
    {
        $this->set($date);
    }

    /**
     * Get the time value stored in the object
     * @return int The time value stored in the object
     */
    public function getTime() : int
    {
        return $this->time;
    }

    /**
     * Set the date and time.
     * @param mixed $date The date and time to set. Accepts a UNIX timestamp, a string in a valid date and time format, or null to set the current date and time.
     * @return Date The updated Date object.
     */
    public function set(mixed $date = null): Date
    {
        if (is_null($date)) {
            $this->time = time();
        } elseif (is_int($date)) {
            $this->time = $date;
        } else {
            $this->time = strtotime($date);
        }

        return $this;
    }

    /**
     * Set the format for the date
     * @param string|null $format The format to be applied to the date. If null is provided, the default format 'Y-m-d H:i:s' will be used.
     * @return Date The updated Date object with the new format applied.
     */
    public function format(?string $format): Date
    {
        self::$format = $format;

        return $this;
    }

    /**
     * Add seconds to the Date object
     * @param int $seconds The number of seconds to add
     * @return Date The updated Date object
     */
    public function addSecond(int $seconds): Date
    {
        $this->time = strtotime('+' . $seconds . ' SECONDS', $this->time);

        return $this;
    }

    /**
     * Add minutes to the date.
     * @param int $minutes The number of minutes to add.
     * @return Date The Date object.
     */
    public function addMinute(int $minutes): Date
    {
        $this->time = strtotime('+' . $minutes . ' MINUTES', $this->time);

        return $this;
    }

    /**
     * Add hours to the Date object
     * @param int $hours The number of hours to add
     * @return Date The updated Date object
     */
    public function addHour(int $hours): Date
    {
        $this->time = strtotime('+' . $hours . ' HOURS', $this->time);

        return $this;
    }

    /**
     * Add days to the date
     * @param int $days The number of days to add
     * @return Date Returns the updated Date object
     */
    public function addDay(int $days): Date
    {
        $this->time = strtotime('+' . $days . ' DAYS', $this->time);

        return $this;
    }

    /**
     * Add months to the date
     * @param int $months The number of months to add to the date
     * @return Date The updated date object
     */
    public function addMonth(int $months): Date
    {
        $this->time = strtotime('+' . $months . ' MONTHS', $this->time);

        return $this;
    }

    /**
     * Add years to the date
     * @param int $years The number of years to add
     * @return Date The updated Date object
     */
    public function addYear(int $years): Date
    {
        $this->time = strtotime('+' . $years . ' YEARS', $this->time);

        return $this;
    }

    /**
     * Subtracting seconds from date
     * @param int $seconds
     * @return Date
     */
    public function subSecond(int $seconds): Date
    {
        $this->time = strtotime('-' . $seconds . ' SECONDS', $this->time);

        return $this;
    }

    /**
     * Subtract minutes from the current date and time.
     * @param int $minutes The number of minutes to subtract.
     * @return Date $this The updated Date object.
     */
    public function subMinute(int $minutes): Date
    {
        $this->time = strtotime('-' . $minutes . ' MINUTES', $this->time);

        return $this;
    }

    /**
     * Subtracts specified number of hours to the current date and time.
     * @param int $hours The number of hours to subtract.
     * @return Date Returns the modified Date object after subtracting the specified hours.
     */
    public function subHour(int $hours): Date
    {
        $this->time = strtotime('-' . $hours . ' HOURS', $this->time);

        return $this;
    }

    /**
     * Subtract number of days from the current date.
     * @param int $days The number of days to subtract.
     * @return Date The updated Date object.
     */
    public function subDay(int $days): Date
    {
        $this->time = strtotime('-' . $days . ' DAYS', $this->time);

        return $this;
    }

    /**
     * Subtract given number of months from the date.
     * @param int $months The number of months to subtract.
     * @return Date The updated Date object.
     */
    public function subMonth(int $months): Date
    {
        $this->time = strtotime('-' . $months . ' MONTHS', $this->time);

        return $this;
    }

    /**
     * Subtract years from date
     * @param int $years The number of years to subtract
     * @return Date The updated Date object with years subtracted
     */
    public function subYear(int $years): Date
    {
        $this->time = strtotime('-' . $years . ' YEARS', $this->time);

        return $this;
    }

    /**
     * Get date
     * This method returns the date in either integer or string format. By default, it uses the format 'Y-m-d H:i:s'.
     * If the format is null, it returns the date as a string using the getTime method of the class.
     * @return int|string The date in the specified format. If the format is null, it returns the date as a string.
     */
    public function getDate(): int|string
    {
        return $this->__toString();
    }

    /**
     * Returns a string representation of the object.
     * Converts the Time object to a string based on the defined format. If the format is not set,
     * it returns the result of the getTime() method.
     * @return string The string representation of the object.
     */
    public function __toString() {
        if (is_null(self::$format)) {
            return $this->getTime();
        }

        return date(self::$format, $this->time);
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
    public static function getSecondsToDate(string|int $date) : int {
        return round(abs(time() - (is_int($date) ? $date : strtotime($date))));
    }

}