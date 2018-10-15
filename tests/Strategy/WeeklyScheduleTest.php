<?php

namespace jjok\Switches\Strategy;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Strategy\WeeklySchedule
 * @uses \jjok\Switches\Weekly\DayOfWeek
 */
final class WeeklyScheduleTest extends TestCase
{
    public function testNothingIsScheduledIfNoDaysAreAdded()
    {
        $schedule = new WeeklySchedule([]);

        assertIsOffAt('now', $schedule);
    }

    public function testNothingIsScheduledIfNoTimePeriodsAreAdded()
    {
        $schedule = new WeeklySchedule([
            $this->unscheduledDay(),
            $this->unscheduledDay(),
            $this->unscheduledDay(),
        ]);

        assertIsOffAt('now', $schedule);
    }

    public function testTimeIsScheduledIfScheduleContainsADayThatIsScheduled() {
        $schedule = new WeeklySchedule([
            $this->scheduledDay(),
        ]);

        assertIsOnAt('now', $schedule);
    }

    public function testOnlyOneDayHasToBeScheduled()
    {
        $schedule = new WeeklySchedule([
            $this->unscheduledDay(),
            $this->unscheduledDay(),
            $this->unscheduledDay(),
            $this->scheduledDay(),
            $this->unscheduledDay(),
        ]);

        assertIsOnAt('now', $schedule);
    }

    private function scheduledDay()
    {
        return $this->mockDayOfWeek(true);
    }

    private function unscheduledDay()
    {
        return $this->mockDayOfWeek(false);
    }


    private function mockDayOfWeek(bool $isScheduled)
    {
        $day = $this->getMockBuilder('jjok\Switches\Weekly\DayOfWeek')
            ->disableOriginalConstructor()
            ->getMock();

        $day->method('isScheduledAt')->willReturn($isScheduled);

        return $day;
    }
}
