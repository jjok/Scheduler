<?php

namespace jjok\Switches\Strategy;

use jjok\Switches\Period;
use jjok\Switches\Weekly\DayOfWeek;
use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Strategy\WeeklySchedule
 * @uses \jjok\Switches\Period
 * @uses \jjok\Switches\Time
 * @uses \jjok\Switches\Weekly\DayOfWeek
 */
final class WeeklyScheduleTest extends TestCase
{
    public function dateProvider() : array
    {
        return [
            ['2018-10-22 00:00:00'],
            ['2018-10-23 09:01:30'],
            ['2018-10-24 12:01:12'],
            ['2018-10-25 14:01:00'],
            ['2018-10-26 15:01:33'],
            ['2018-10-27 19:01:00'],
            ['2018-10-28 23:59:59'],
        ];
    }

    /**
     * @test
     * @dataProvider dateProvider
     */
    public function nothing_is_scheduled_if_no_days_are_added(string $time)
    {
        $schedule = new WeeklySchedule([]);

        assertShouldBeOffAt($time, $schedule);
    }

    /**
     * @test
     * @dataProvider dateProvider
     */
    public function it_is_on_during_scheduled_times(string $time)
    {
        $schedule = new WeeklySchedule([
            DayOfWeek::Monday(   [Period::fromStrings('00:00:00', '23:59:59')]),
            DayOfWeek::Tuesday(  [Period::fromStrings('00:00:00', '23:59:59')]),
            DayOfWeek::Wednesday([Period::fromStrings('00:00:00', '23:59:59')]),
            DayOfWeek::Thursday( [Period::fromStrings('00:00:00', '23:59:59')]),
            DayOfWeek::Friday(   [Period::fromStrings('00:00:00', '23:59:59')]),
            DayOfWeek::Saturday( [Period::fromStrings('00:00:00', '23:59:59')]),
            DayOfWeek::Sunday(   [Period::fromStrings('00:00:00', '23:59:59')]),
        ]);

        assertShouldBeOnAt($time, $schedule);
    }

    /**
     * @test
     * @dataProvider dateProvider
     */
    public function it_is_off_during_unscheduled_times(string $time)
    {
        $schedule = new WeeklySchedule([
            DayOfWeek::Monday(   [Period::fromStrings('00:00:01', '23:59:59')]),
            DayOfWeek::Tuesday(  [Period::fromStrings('10:00:00', '23:59:59')]),
            DayOfWeek::Wednesday([Period::fromStrings('12:01:13', '23:59:59')]),
            DayOfWeek::Thursday( [Period::fromStrings('00:00:00', '14:00:59')]),
            DayOfWeek::Friday(   [Period::fromStrings('15:01:40', '23:59:59')]),
            DayOfWeek::Saturday( [Period::fromStrings('00:00:00', '19:00:00')]),
            DayOfWeek::Sunday(   [Period::fromStrings('00:00:00', '23:59:58')]),
        ]);

        assertShouldBeOffAt($time, $schedule);
    }
}
