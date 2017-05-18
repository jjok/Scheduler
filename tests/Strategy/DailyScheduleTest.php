<?php

namespace jjok\Scheduler\Strategy;

use PHPUnit\Framework\TestCase;

final class DailyScheduleTest extends TestCase
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
