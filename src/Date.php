<?php

namespace Krzysztofzylka\Date;

use DateTime;
use Exception;

/**
 * Operating on date
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
     * Static constructor
     * @param mixed $date
     * @return Date
     */
    public static function create($date = null): Date
    {
        return new Date($date);
    }

    /**
     * Constructor for the class.
     * @param mixed $date Optional. The initial date value, defaults to null.
     * @return void
     */
    public function __construct($date = null)
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
     * @param int|string|DateTime|Date|null $date The date and time to set.
     *                                            - int: A UNIX timestamp.
     *                                            - string: A string in a valid date and time format (e.g., 'Y-m-d H:i:s').
     *                                            - DateTime: An instance of the DateTime class.
     *                                            - Date: An instance of the Date class (custom implementation).
     *                                            - null: Sets the current date and time.
     * @return Date The updated Date object.
     * @throws Exception If the provided date is invalid or cannot be parsed.
     */
    public function set($date = null): Date
    {
        if ($date instanceof Date) {
            $this->time = $date->getTime();
        } elseif (is_null($date)) {
            $this->time = time();
        } elseif (is_int($date)) {
            $this->time = $date;
        } elseif ($date instanceof DateTime) {
            $this->time = $date->getTimestamp();
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
     * @param bool $fixCalculate
     * @return Date The updated date object
     * @throws Exception
     */
    public function addMonth(int $months, bool $fixCalculate = true): Date
    {
        if ($fixCalculate) {
            $previousDate = $this->time;
            $this->time = strtotime('+' . $months . ' MONTHS', $this->time);
            $monthDifference = DateUtils::dateMonthDifference(date('Y-m-d', $previousDate), date('Y-m-d', $this->time));

            if ($monthDifference > $months) {
                $this->time = strtotime(date('Y-m-t H:i:s.u', strtotime('previous month', $this->time)));
            }
        } else {
            $this->time = strtotime('+' . $months . ' MONTHS', $this->time);
        }

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
     * @param string|null $format
     * @return int|string The date in the specified format. If the format is null, it returns the date as a string.
     */
    public function getDate(?string $format = null)
    {
        if (is_null(self::$format)) {
            return $this->getTime();
        }

        return date($format ?? self::$format, $this->time);
    }

    /**
     * Get the difference between the current date and another date.
     * @param Date|string|DateTime|int|null $date The date to compare. Accepts various formats (Date, DateTime, string, UNIX timestamp, or null).
     * @return array An array containing the difference in years, months, days, hours, minutes, and seconds.
     * @throws Exception If the provided date is invalid.
     */
    public function getDifference($date): array
    {
        return DateUtils::getDifference($this, $date);
    }

    /**
     * Check if the current date is before another date.
     *
     * @param Date|string|DateTime|int|null $date The date to compare.
     * @return bool True if the current date is before the given date.
     * @throws Exception If the provided date is invalid.
     */
    public function isBefore($date): bool
    {
        return $this->getTime() < Date::create($date)->getTime();
    }

    /**
     * Check if the current date is after another date.
     *
     * @param Date|string|DateTime|int|null $date The date to compare.
     * @return bool True if the current date is after the given date.
     * @throws Exception If the provided date is invalid.
     */
    public function isAfter($date): bool
    {
        return $this->time > Date::create($date)->getTime();
    }

    /**
     * Set the time to the start of the day (00:00:00).
     * @return Date The updated Date object.
     */
    public function startOfDay(): Date
    {
        $this->time = strtotime(date('Y-m-d 00:00:00', $this->time));

        return $this;
    }

    /**
     * Set the time to the end of the day (23:59:59).
     * @return Date The updated Date object.
     */
    public function endOfDay(): Date
    {
        $this->time = strtotime(date('Y-m-d 23:59:59', $this->time));

        return $this;
    }

    /**
     * Check if the current date is equal to another date.
     * @param Date|string|DateTime|int|null $date The date to compare.
     * @return bool True if the dates are equal, false otherwise.
     * @throws Exception If the provided date is invalid.
     */
    public function isEqual($date): bool
    {
        return $this->getTime() === Date::create($date)->getTime();
    }

    /**
     * Get the date in ISO 8601 format.
     * @return string The date in ISO 8601 format.
     */
    public function getISO8601(): string
    {
        return date('c', $this->time);
    }

    /**
     * Check if the date is a weekend.
     * @return bool True if the date is a weekend, false otherwise.
     */
    public function isWeekend(): bool
    {
        $dayOfWeek = (int)date('N', $this->time); // 6 = Saturday, 7 = Sunday

        return $dayOfWeek >= 6;
    }

    /**
     * Check if the date is a weekday.
     * @return bool True if the date is a weekday, false otherwise.
     */
    public function isWeekday(): bool
    {
        return !$this->isWeekend();
    }

    /**
     * Get the number of weekdays between the current date and another date.
     * @param Date|string|DateTime|int|null $date The date to compare.
     * @return int The number of weekdays between the two dates.
     * @throws Exception If the provided date is invalid.
     */
    public function getWeekdayDifference($date): int
    {
        $start = min($this->time, Date::create($date)->getTime());
        $end = max($this->time, Date::create($date)->getTime());

        $days = 0;
        for ($current = $start; $current <= $end; $current += self::$DAY) {
            $dayOfWeek = (int)date('N', $current);
            if ($dayOfWeek < 6) { // Monday to Friday
                $days++;
            }
        }

        return $days;
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

}