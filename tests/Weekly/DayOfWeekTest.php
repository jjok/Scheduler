<?php

namespace jjok\Switches\Weekly;

use jjok\Switches\Period;
use jjok\Switches\Time;
use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Weekly\DayOfWeek
 * @uses \jjok\Switches\Period
 * @uses \jjok\Switches\Time
 */
final class DayOfWeekTest extends TestCase
{
    public function testOnlyTimePeriodsCanBeAddedToDay()
    {
        $this->expectException('TypeError');
        DayOfWeek::Monday([new \stdClass()]);
    }

    public function testNothingWillBeScheduledIfNoTimePeriodsAreAdded()
    {
        $monday = DayOfWeek::Monday([]);

        $this->assertTimeOfDayIsNotScheduled($monday, 1, '00:00:00');
        $this->assertTimeOfDayIsNotScheduled($monday, 1, '12:21:45');
        $this->assertTimeOfDayIsNotScheduled($monday, 1, '23:59:59');
    }

    public function testMondayCanBeCreated()
    {
        $monday = DayOfWeek::Monday([$this->mockPeriod('00:00:00', '23:59:59')]);

        $this->assertTimeOfDayIsNotScheduled($monday, 7, '23:59:59');
        $this->assertTimeOfDayIsScheduled($monday, 1, '00:00:00');
        $this->assertTimeOfDayIsScheduled($monday, 1, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($monday, 2, '00:00:00');
    }

    public function testTuesdayCanBeCreated()
    {
        $tuesday = DayOfWeek::Tuesday([$this->mockPeriod('00:00:01', '23:59:59')]);

        $this->assertTimeOfDayIsNotScheduled($tuesday, 1, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($tuesday, 2, '00:00:00');
        $this->assertTimeOfDayIsScheduled($tuesday, 2, '00:00:01');
        $this->assertTimeOfDayIsScheduled($tuesday, 2, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($tuesday, 3, '00:00:00');
    }

    public function testWednesdayCanBeCreated()
    {
        $wednesday = DayOfWeek::Wednesday([$this->mockPeriod('00:00:00', '23:59:58')]);

        $this->assertTimeOfDayIsNotScheduled($wednesday, 2, '23:59:59');
        $this->assertTimeOfDayIsScheduled($wednesday, 3, '00:00:00');
        $this->assertTimeOfDayIsScheduled($wednesday, 3, '23:59:58');
        $this->assertTimeOfDayIsNotScheduled($wednesday, 3, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($wednesday, 4, '00:00:00');
    }

    public function testThursdayCanBeCreated()
    {
        $thursday = DayOfWeek::Thursday([$this->mockPeriod('00:00:00', '23:59:59')]);

        $this->assertTimeOfDayIsNotScheduled($thursday, 3, '23:59:59');
        $this->assertTimeOfDayIsScheduled($thursday, 4, '00:00:00');
        $this->assertTimeOfDayIsScheduled($thursday, 4, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($thursday, 5, '00:00:00');
    }

    public function testFridayCanBeCreated()
    {
        $friday = DayOfWeek::Friday([$this->mockPeriod('00:00:00', '23:59:59')]);

        $this->assertTimeOfDayIsNotScheduled($friday, 4, '23:59:59');
        $this->assertTimeOfDayIsScheduled($friday, 5, '00:00:00');
        $this->assertTimeOfDayIsScheduled($friday, 5, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($friday, 6, '00:00:00');
    }

    public function testSaturdayCanBeCreated()
    {
        $saturday = DayOfWeek::Saturday([$this->mockPeriod('00:00:00', '23:59:59')]);

        $this->assertTimeOfDayIsNotScheduled($saturday, 5, '23:59:59');
        $this->assertTimeOfDayIsScheduled($saturday, 6, '00:00:00');
        $this->assertTimeOfDayIsScheduled($saturday, 6, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($saturday, 7, '00:00:00');
    }

    public function testSundayCanBeCreated()
    {
        $sunday = DayOfWeek::Sunday([$this->mockPeriod('00:00:00', '23:59:59')]);

        $this->assertTimeOfDayIsNotScheduled($sunday, 6, '23:59:59');
        $this->assertTimeOfDayIsScheduled($sunday, 7, '00:00:00');
        $this->assertTimeOfDayIsScheduled($sunday, 7, '23:59:59');
        $this->assertTimeOfDayIsNotScheduled($sunday, 1, '00:00:00');
    }

    private function mockPeriod(string $start, string $end)
    {
        return new Period(Time::fromString($start), Time::fromString($end));
    }

    //TODO Name this better
    private function assertTimeOfDayIsScheduled(DayOfWeek $dayOfWeek, int $day, string $time)
    {
        $this->assertTrue($dayOfWeek->isScheduledAt($day, Time::fromString($time)));
    }

    //TODO Name this better
    private function assertTimeOfDayIsNotScheduled(DayOfWeek $dayOfWeek, int $day, string $time)
    {
        $this->assertFalse($dayOfWeek->isScheduledAt($day, Time::fromString($time)));
    }
}
