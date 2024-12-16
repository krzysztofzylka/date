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

    public function testCreate()
    {
        $datetime = new DateTime();
        $date = Date::create($datetime);

        $this->assertEquals($datetime->getTimestamp(), $date->getTime());
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

    public function testGetDifference()
    {
        $date = \Krzysztofzylka\Date\Date::create();
        $date2 = \Krzysztofzylka\Date\Date::create($date)->addDay(1);
        $this->assertEquals($date->getDifference($date2), ['years' => 0, 'months' => 0, 'days' => 1, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addDay(1);
        $this->assertEquals($date->getDifference($date2), ['years' => 0, 'months' => 0, 'days' => 2, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addMonth(5);
        $this->assertEquals($date->getDifference($date2), ['years' => 0, 'months' => 5, 'days' => 2, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addYear(8);
        $this->assertEquals($date->getDifference($date2), ['years' => 8, 'months' => 5, 'days' => 2, 'hours' => 0, 'minutes' => 0, 'seconds' => 0]);
        $date2->addMinute(5);
        $date2->addSecond(155);
        $this->assertEquals($date->getDifference($date2), ['years' => 8, 'months' => 5, 'days' => 2, 'hours' => 0, 'minutes' => 7, 'seconds' => 35]);
        $date2->addMonth(129);
        $this->assertEquals($date->getDifference($date2), ['years' => 19, 'months' => 2, 'days' => 2, 'hours' => 0, 'minutes' => 7, 'seconds' => 35]);
    }

    public function testIsBefore()
    {
        $this->assertTrue(Date::create()->isBefore(Date::create()->addDay(2)));
        $this->assertFalse(Date::create()->isBefore(Date::create()->subDay(2)));
        $this->assertFalse(Date::create()->isBefore(Date::create()));
    }

    public function testIsAfter()
    {
        $this->assertFalse(Date::create()->isAfter(Date::create()->addDay(2)));
        $this->assertTrue(Date::create()->isAfter(Date::create()->subDay(2)));
        $this->assertFalse(Date::create()->isAfter(Date::create()));
    }

    public function testIsEqual()
    {
        $this->assertFalse(Date::create()->isEqual(Date::create()->addDay(2)));
        $this->assertFalse(Date::create()->isEqual(Date::create()->subDay(2)));
        $this->assertTrue(Date::create()->isEqual(Date::create()));
    }

    public function testStartDayOf()
    {
        $this->assertEquals(Date::create()->startOfDay(), date('Y-m-d 00:00:00'));
    }

    public function testEndOfDay()
    {
        $this->assertEquals(Date::create()->endOfDay(), date('Y-m-d 23:59:59'));
    }

}
