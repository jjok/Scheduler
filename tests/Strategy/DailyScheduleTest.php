<?php

namespace jjok\Scheduler\Strategy;

use jjok\Scheduler\Period;
use jjok\Scheduler\Time;
use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Scheduler\Strategy\DailySchedule
 * @uses \jjok\Scheduler\Period
 * @uses \jjok\Scheduler\Time
 */
final class DailyScheduleTest extends TestCase
{
    public function testNothingIsScheduledIfNoTimePeriodsAreAdded()
    {
        $strategy = new DailySchedule([]);

        $this->assertFalse($strategy->isOnAt(new \DateTime()));
    }

    public function testIsNotOnBetweenScheduledTimePeriods()
    {
        $strategy = new DailySchedule([
            $this->period('06:34:23', '12:00:21'),
            $this->period('13:00:00', '13:25:01'),
            $this->period('19:01:59', '23:20:19'),
        ]);

        $this->assertIsOffAt('00:00:00', $strategy);
        $this->assertIsOffAt('05:10:00', $strategy);
        $this->assertIsOffAt('06:34:22', $strategy);
        $this->assertIsOffAt('12:00:22', $strategy);
        $this->assertIsOffAt('19:01:58', $strategy);
        $this->assertIsOffAt('23:20:20', $strategy);
        $this->assertIsOffAt('23:59:59', $strategy);
    }


    public function testIsOnAtScheduledTimePeriods()
    {
        $strategy = new DailySchedule([
            $this->period('06:34:23', '12:00:21'),
            $this->period('13:00:00', '13:25:01'),
            $this->period('19:01:59', '23:20:19'),
        ]);

        $this->assertIsOnAt('06:34:23', $strategy);
        $this->assertIsOnAt('10:30:12', $strategy);
        $this->assertIsOnAt('12:00:21', $strategy);
        $this->assertIsOnAt('13:00:00', $strategy);
        $this->assertIsOnAt('13:25:01', $strategy);
        $this->assertIsOnAt('19:01:59', $strategy);
        $this->assertIsOnAt('23:20:19', $strategy);
    }

    private function assertIsOffAt(string $time, DailySchedule $strategy)
    {
        $this->assertFalse($strategy->isOnAt(new \DateTimeImmutable($time)));
    }

    private function assertIsOnAt(string $time, DailySchedule $strategy)
    {
        $this->assertTrue($strategy->isOnAt(new \DateTimeImmutable($time)));
    }

    private function period(string $start, string $end)
    {
        return new Period(
            Time::fromString($start),
            Time::fromString($end)
        );
    }
}
