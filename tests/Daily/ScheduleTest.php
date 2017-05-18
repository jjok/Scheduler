<?php

namespace jjok\Scheduler\Daily;

use jjok\Scheduler\Strategy\DailySchedule;
use PHPUnit\Framework\TestCase;

final class ScheduleTest extends TestCase
{
    public function testNothingIsScheduledIfNoTimePeriodsAreAdded()
    {
        $schedule = new DailySchedule([]);

        $this->assertFalse($schedule->isOnAt(new \DateTime()));
    }

    public function testIsNotOnBetweenScheduledTimePeriods()
    {

    }

    public function testIsOnAtScheduledTimePeriods()
    {

    }
}
