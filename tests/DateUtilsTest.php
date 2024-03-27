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
}
