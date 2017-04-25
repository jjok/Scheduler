<?php

namespace jjok\Scheduler\Weekly;

use jjok\Scheduler\Period;
use jjok\Scheduler\Time;
use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Scheduler\Weekly\DayOfWeek
 * @uses \jjok\Scheduler\Period
 * @uses \jjok\Scheduler\Time
 */
final class DayOfWeekTest extends TestCase
{
    public function testOnlyTimePeriodsCanBeAddedToDay()
    {
        $this->expectException('TypeError');
        DayOfWeek::Monday([new \stdClass()]);
    }

    public function testMondayCanBeCreated()
    {
        $monday = DayOfWeek::Monday([$this->createPeriod()]);

        $this->assertFalse($monday->isScheduledAt(7, Time::fromString('23:59:59')));
        $this->assertTrue($monday->isScheduledAt(1, Time::fromString('00:00:00')));
        $this->assertTrue($monday->isScheduledAt(1, Time::fromString('23:59:59')));
        $this->assertFalse($monday->isScheduledAt(2, Time::fromString('00:00:00')));
    }

    public function testTuesdayCanBeCreated()
    {
        $tuesday = DayOfWeek::Tuesday([$this->createPeriod()]);

        $this->assertFalse($tuesday->isScheduledAt(1, Time::fromString('23:59:59')));
        $this->assertTrue($tuesday->isScheduledAt(2, Time::fromString('00:00:00')));
        $this->assertTrue($tuesday->isScheduledAt(2, Time::fromString('23:59:59')));
        $this->assertFalse($tuesday->isScheduledAt(3, Time::fromString('00:00:00')));
    }

    public function testWednesdayCanBeCreated()
    {
        $wednesday = DayOfWeek::Wednesday([$this->createPeriod()]);

        $this->assertFalse($wednesday->isScheduledAt(2, Time::fromString('23:59:59')));
        $this->assertTrue($wednesday->isScheduledAt(3, Time::fromString('00:00:00')));
        $this->assertTrue($wednesday->isScheduledAt(3, Time::fromString('23:59:59')));
        $this->assertFalse($wednesday->isScheduledAt(4, Time::fromString('00:00:00')));
    }

    public function testThursdayCanBeCreated()
    {
        $thursday = DayOfWeek::Thursday([$this->createPeriod()]);

        $this->assertFalse($thursday->isScheduledAt(3, Time::fromString('23:59:59')));
        $this->assertTrue($thursday->isScheduledAt(4, Time::fromString('00:00:00')));
        $this->assertTrue($thursday->isScheduledAt(4, Time::fromString('23:59:59')));
        $this->assertFalse($thursday->isScheduledAt(5, Time::fromString('00:00:00')));
    }

    public function testFridayCanBeCreated()
    {
        $friday = DayOfWeek::Friday([$this->createPeriod()]);

        $this->assertFalse($friday->isScheduledAt(4, Time::fromString('23:59:59')));
        $this->assertTrue($friday->isScheduledAt(5, Time::fromString('00:00:00')));
        $this->assertTrue($friday->isScheduledAt(5, Time::fromString('23:59:59')));
        $this->assertFalse($friday->isScheduledAt(6, Time::fromString('00:00:00')));
    }

    public function testSaturdayCanBeCreated()
    {
        $saturday = DayOfWeek::Saturday([$this->createPeriod()]);

        $this->assertFalse($saturday->isScheduledAt(5, Time::fromString('23:59:59')));
        $this->assertTrue($saturday->isScheduledAt(6, Time::fromString('00:00:00')));
        $this->assertTrue($saturday->isScheduledAt(6, Time::fromString('23:59:59')));
        $this->assertFalse($saturday->isScheduledAt(7, Time::fromString('00:00:00')));
    }

    public function testSundayCanBeCreated()
    {
        $sunday = DayOfWeek::Sunday([$this->createPeriod()]);

        $this->assertFalse($sunday->isScheduledAt(6, Time::fromString('23:59:59')));
        $this->assertTrue($sunday->isScheduledAt(7, Time::fromString('00:00:00')));
        $this->assertTrue($sunday->isScheduledAt(7, Time::fromString('23:59:59')));
        $this->assertFalse($sunday->isScheduledAt(1, Time::fromString('00:00:00')));
    }

    private function createPeriod()
    {
        return new Period(Time::fromString('00:00:00'), Time::fromString('23:59:59'));
    }
}
