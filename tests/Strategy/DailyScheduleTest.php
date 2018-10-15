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

        assertIsOffAt('now', $strategy);
    }

    public function testIsNotOnBetweenScheduledTimePeriods()
    {
        $strategy = new DailySchedule([
            $this->period('06:34:23', '12:00:21'),
            $this->period('13:00:00', '13:25:01'),
            $this->period('19:01:59', '23:20:19'),
        ]);

        assertIsOffAt('00:00:00', $strategy);
        assertIsOffAt('05:10:00', $strategy);
        assertIsOffAt('06:34:22', $strategy);
        assertIsOffAt('12:00:22', $strategy);
        assertIsOffAt('19:01:58', $strategy);
        assertIsOffAt('23:20:20', $strategy);
        assertIsOffAt('23:59:59', $strategy);
    }

    public function testIsOnAtScheduledTimePeriods()
    {
        $strategy = new DailySchedule([
            $this->period('06:34:23', '12:00:21'),
            $this->period('13:00:00', '13:25:01'),
            $this->period('19:01:59', '23:20:19'),
        ]);

        assertIsOnAt('06:34:23', $strategy);
        assertIsOnAt('10:30:12', $strategy);
        assertIsOnAt('12:00:21', $strategy);
        assertIsOnAt('13:00:00', $strategy);
        assertIsOnAt('13:25:01', $strategy);
        assertIsOnAt('19:01:59', $strategy);
        assertIsOnAt('23:20:19', $strategy);
    }

    private function period(string $start, string $end) : Period
    {
        return new Period(
            Time::fromString($start),
            Time::fromString($end)
        );
    }
}
