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

        $this->assertFalse($monday->hasAPeriodThatIsNow(7, Time::fromString('23:59:59')));
        $this->assertTrue($monday->hasAPeriodThatIsNow(1, Time::fromString('00:00:00')));
        $this->assertTrue($monday->hasAPeriodThatIsNow(1, Time::fromString('23:59:59')));
        $this->assertFalse($monday->hasAPeriodThatIsNow(2, Time::fromString('00:00:00')));
    }

    public function testTuesdayCanBeCreated()
    {
        $tuesday = DayOfWeek::Tuesday([$this->createPeriod()]);

        $this->assertFalse($tuesday->hasAPeriodThatIsNow(1, Time::fromString('23:59:59')));
        $this->assertTrue($tuesday->hasAPeriodThatIsNow(2, Time::fromString('00:00:00')));
        $this->assertTrue($tuesday->hasAPeriodThatIsNow(2, Time::fromString('23:59:59')));
        $this->assertFalse($tuesday->hasAPeriodThatIsNow(3, Time::fromString('00:00:00')));
    }

    public function testWednesdayCanBeCreated()
    {
        $wednesday = DayOfWeek::Wednesday([$this->createPeriod()]);

        $this->assertFalse($wednesday->hasAPeriodThatIsNow(2, Time::fromString('23:59:59')));
        $this->assertTrue($wednesday->hasAPeriodThatIsNow(3, Time::fromString('00:00:00')));
        $this->assertTrue($wednesday->hasAPeriodThatIsNow(3, Time::fromString('23:59:59')));
        $this->assertFalse($wednesday->hasAPeriodThatIsNow(4, Time::fromString('00:00:00')));
    }

    public function testThursdayCanBeCreated()
    {
        $thursday = DayOfWeek::Thursday([$this->createPeriod()]);

        $this->assertFalse($thursday->hasAPeriodThatIsNow(3, Time::fromString('23:59:59')));
        $this->assertTrue($thursday->hasAPeriodThatIsNow(4, Time::fromString('00:00:00')));
        $this->assertTrue($thursday->hasAPeriodThatIsNow(4, Time::fromString('23:59:59')));
        $this->assertFalse($thursday->hasAPeriodThatIsNow(5, Time::fromString('00:00:00')));
    }

    public function testFridayCanBeCreated()
    {
        $friday = DayOfWeek::Friday([$this->createPeriod()]);

        $this->assertFalse($friday->hasAPeriodThatIsNow(4, Time::fromString('23:59:59')));
        $this->assertTrue($friday->hasAPeriodThatIsNow(5, Time::fromString('00:00:00')));
        $this->assertTrue($friday->hasAPeriodThatIsNow(5, Time::fromString('23:59:59')));
        $this->assertFalse($friday->hasAPeriodThatIsNow(6, Time::fromString('00:00:00')));
    }

    public function testSaturdayCanBeCreated()
    {
        $saturday = DayOfWeek::Saturday([$this->createPeriod()]);

        $this->assertFalse($saturday->hasAPeriodThatIsNow(5, Time::fromString('23:59:59')));
        $this->assertTrue($saturday->hasAPeriodThatIsNow(6, Time::fromString('00:00:00')));
        $this->assertTrue($saturday->hasAPeriodThatIsNow(6, Time::fromString('23:59:59')));
        $this->assertFalse($saturday->hasAPeriodThatIsNow(7, Time::fromString('00:00:00')));
    }

    public function testSundayCanBeCreated()
    {
        $sunday = DayOfWeek::Sunday([$this->createPeriod()]);

        $this->assertFalse($sunday->hasAPeriodThatIsNow(6, Time::fromString('23:59:59')));
        $this->assertTrue($sunday->hasAPeriodThatIsNow(7, Time::fromString('00:00:00')));
        $this->assertTrue($sunday->hasAPeriodThatIsNow(7, Time::fromString('23:59:59')));
        $this->assertFalse($sunday->hasAPeriodThatIsNow(1, Time::fromString('00:00:00')));
    }

    private function createPeriod()
    {
        return new Period(Time::fromString('00:00:00'), Time::fromString('23:59:59'));
    }
}
