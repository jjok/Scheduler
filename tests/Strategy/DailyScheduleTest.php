<?php

namespace jjok\Switches\Strategy;

use jjok\Switches\Period;
use jjok\Switches\Time;
use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Strategy\DailySchedule
 * @uses \jjok\Switches\Period
 * @uses \jjok\Switches\Time
 */
final class DailyScheduleTest extends TestCase
{
    public function testNothingIsScheduledIfNoTimePeriodsAreAdded()
    {
        $strategy = new DailySchedule([]);

        assertShouldBeOffAt('now', $strategy);
    }

    public function testIsNotOnBetweenScheduledTimePeriods()
    {
        $strategy = new DailySchedule([
            $this->period('06:34:23', '12:00:21'),
            $this->period('13:00:00', '13:25:01'),
            $this->period('19:01:59', '23:20:19'),
        ]);

        assertShouldBeOffAt('00:00:00', $strategy);
        assertShouldBeOffAt('05:10:00', $strategy);
        assertShouldBeOffAt('06:34:22', $strategy);
        assertShouldBeOffAt('12:00:22', $strategy);
        assertShouldBeOffAt('19:01:58', $strategy);
        assertShouldBeOffAt('23:20:20', $strategy);
        assertShouldBeOffAt('23:59:59', $strategy);
    }

    public function testIsOnAtScheduledTimePeriods()
    {
        $strategy = new DailySchedule([
            $this->period('06:34:23', '12:00:21'),
            $this->period('13:00:00', '13:25:01'),
            $this->period('19:01:59', '23:20:19'),
        ]);

        assertShouldBeOnAt('06:34:23', $strategy);
        assertShouldBeOnAt('10:30:12', $strategy);
        assertShouldBeOnAt('12:00:21', $strategy);
        assertShouldBeOnAt('13:00:00', $strategy);
        assertShouldBeOnAt('13:25:01', $strategy);
        assertShouldBeOnAt('19:01:59', $strategy);
        assertShouldBeOnAt('23:20:19', $strategy);
    }

    private function period(string $start, string $end) : Period
    {
        return new Period(
            Time::fromString($start),
            Time::fromString($end)
        );
    }
}
