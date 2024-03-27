<?php

use Krzysztofzylka\Date\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testStaticVariables()
    {
        $this->assertEquals(2592000, Date::$MONTH, 'Month in seconds does not match');
        $this->assertEquals(86400, Date::$DAY, 'Day in seconds does not match');
        $this->assertEquals(3600, Date::$HOUR, 'Hour in seconds does not match');
        $this->assertEquals(60, Date::$MINUTE, 'Minute in seconds does not match');
    }

    public function testGetSimpleDateWithoutMicroseconds()
    {
        $date = Date::getSimpleDate(false);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $date, 'The date format without microseconds does not match');
    }

    public function testGetSimpleDateWithMicroseconds()
    {
        $dateWithMicroseconds = Date::getSimpleDate(true);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d{6}$/', $dateWithMicroseconds, 'The date format with microseconds does not match');
    }

    public function testGetTimeReturnsCorrectTimestamp()
    {
        $timestamp = 1609459200; // 2021-01-01 00:00:00 UTC
        $date = new Date($timestamp);

        $this->assertEquals($timestamp, $date->getTime(), 'The getTime method does not return the expected timestamp.');
    }

    public function testAddDay()
    {
        $initialDate = '2021-01-01';
        $date = Date::create($initialDate);
        $date->addDay(10);
        $expectedDate = '2021-01-11';
        $this->assertEquals($expectedDate, $date->getDate('Y-m-d'), "Adding days does not result in the expected date.");
    }

    public function testAddMonth()
    {
        $initialDate = '2024-03-31';
        $date = Date::create($initialDate);
        $date->addMonth(1, false);
        $this->assertEquals($date->getDate('Y-m-d'), '2024-05-01');
    }

    public function testAddMonth2()
    {
        $initialDate = '2024-03-31';
        $date = Date::create($initialDate);
        $date->addMonth(1);
        $this->assertEquals($date->getDate('Y-m-d'), '2024-04-30');
    }

    public function testAddYear()
    {
        $date = Date::create('2024-03-31');
        $date->addYear(1);
        $expectedDate = '2025-03-31';
        $this->assertEquals($expectedDate, $date->getDate('Y-m-d'), "Adding days does not result in the expected date.");
    }

}
