<?php

namespace jjok\Switches\Strategy;

/**
 * @covers \jjok\Switches\Strategy\WeeklySchedule
 * @uses \jjok\Switches\Weekly\DayOfWeek
 */
final class WeeklyScheduleTest extends AbstractStrategyTest
{
    public function testNothingIsScheduledIfNoDaysAreAdded()
    {
        $schedule = new WeeklySchedule([]);

        $this->assertIsOffAt('now', $schedule);
    }

    public function testNothingIsScheduledIfNoTimePeriodsAreAdded()
    {
        $schedule = new WeeklySchedule([
            $this->unscheduledDay(),
            $this->unscheduledDay(),
            $this->unscheduledDay(),
        ]);

        $this->assertIsOffAt('now', $schedule);
    }

    public function testTimeIsScheduledIfScheduleContainsADayThatIsScheduled() {
        $schedule = new WeeklySchedule([
            $this->scheduledDay(),
        ]);

        $this->assertIsOnAt('now', $schedule);
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

        $this->assertIsOnAt('now', $schedule);
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
