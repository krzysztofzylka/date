<?php

use Krzysztofzylka\Date\DateUtils;
use PHPUnit\Framework\TestCase;

class DateUtilsTest extends TestCase
{
    /**
     * Test positive difference in months.
     */
    public function testPositiveMonthDifference()
    {
        $dateFrom = '2020-01-01';
        $dateTo = '2020-03-01';
        $expectedDifference = 2;

        $this->assertEquals(
            $expectedDifference,
            DateUtils::dateMonthDifference($dateFrom, $dateTo),
            'The difference in months should be positive and equal to 2.'
        );
    }

    /**
     * Test negative difference in months.
     */
    public function testNegativeMonthDifference()
    {
        $dateFrom = '2020-03-01';
        $dateTo = '2020-01-01';
        $expectedDifference = -2;

        $this->assertEquals(
            $expectedDifference,
            DateUtils::dateMonthDifference($dateFrom, $dateTo),
            'The difference in months should be negative and equal to -2.'
        );
    }

    /**
     * Test difference over a leap year.
     */
    public function testLeapYearMonthDifference()
    {
        $dateFrom = '2020-02-01'; // Leap year
        $dateTo = '2021-02-01';
        $expectedDifference = 12;

        $this->assertEquals(
            $expectedDifference,
            DateUtils::dateMonthDifference($dateFrom, $dateTo),
            'The difference in months over a leap year should be 12.'
        );
    }

    /**
     * Test difference when dates are equal.
     */
    public function testNoMonthDifference()
    {
        $dateFrom = '2020-01-01';
        $dateTo = '2020-01-01';
        $expectedDifference = 0;

        $this->assertEquals(
            $expectedDifference,
            DateUtils::dateMonthDifference($dateFrom, $dateTo),
            'The difference in months should be 0 when dates are equal.'
        );
    }

    /**
     * Test invalid date format throws exception.
     */
    public function testInvalidDateFormat()
    {
        $this->expectException(Exception::class);
        DateUtils::dateMonthDifference('invalid-date', '2020-01-01');
    }

    public function testGetSimpleDateWithoutMicroseconds()
    {
        $date = DateUtils::getSimpleDate(false);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $date, 'The date format without microseconds does not match');
    }

    public function testGetSimpleDateWithMicroseconds()
    {
        $dateWithMicroseconds = DateUtils::getSimpleDate(true);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d{6}$/', $dateWithMicroseconds, 'The date format with microseconds does not match');
    }

    public function testGetDifference()
    {
        $date = \Krzysztofzylka\Date\Date::create();
        $date2 = \Krzysztofzylka\Date\Date::create($date)->addDay(1);
        $this->assertEquals(DateUtils::getDifference($date, $date2), ['years' => 0, 'months' => 0, 'days' => 1, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addDay(1);
        $this->assertEquals(DateUtils::getDifference($date, $date2), ['years' => 0, 'months' => 0, 'days' => 2, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addMonth(5);
        $this->assertEquals(DateUtils::getDifference($date, $date2), ['years' => 0, 'months' => 5, 'days' => 2, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addYear(8);
        $this->assertEquals(DateUtils::getDifference($date, $date2), ['years' => 8, 'months' => 5, 'days' => 2, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addMinute(5);
        $date2->addSecond(155);
        $this->assertEquals(DateUtils::getDifference($date, $date2), ['years' => 8, 'months' => 5, 'days' => 2, 'hours' => 0, 'minutes' => 7, 'seconds' => 35]);
        $date2->addMonth(129);
        $this->assertEquals(DateUtils::getDifference($date, $date2), ['years' => 19, 'months' => 2, 'days' => 2, 'hours' => 0, 'minutes' => 7, 'seconds' => 35]);
    }

}
