<?php

namespace jjok\Scheduler\Weekly;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Scheduler\Weekly\Schedule
 * @uses \jjok\Scheduler\Weekly\DayOfWeek
 */
final class ScheduleTest extends TestCase
{
    public function testNothingIsScheduledIfNoDaysAreAdded()
    {
        $schedule = new Schedule([]);

        $this->assertFalse($schedule->isOnAt(new \DateTime()));
    }

    public function testNothingIsScheduledIfNoTimePeriodsAreAdded()
    {
        $schedule = new Schedule([
            $this->unscheduledDay(),
            $this->unscheduledDay(),
            $this->unscheduledDay(),
        ]);

        $this->assertFalse($schedule->isOnAt($this->anyDate()));
    }

    public function testTimeIsScheduledIfScheduleContainsADayThatIsScheduled() {
        $schedule = new Schedule([
            $this->scheduledDay(),
        ]);

        $this->assertTrue($schedule->isOnAt($this->anyDate()));
    }

    public function testSomething()
    {
        $schedule = new Schedule([
            $this->unscheduledDay(),
            $this->unscheduledDay(),
            $this->unscheduledDay(),
            $this->scheduledDay(),
            $this->unscheduledDay(),
        ]);

        $this->assertTrue($schedule->isOnAt($this->anyDate()));
    }

    private function anyDate()
    {
        return new \DateTimeImmutable();
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
        $day = $this->getMockBuilder('jjok\Scheduler\Weekly\DayOfWeek')
            ->disableOriginalConstructor()
            ->getMock();

        $day->method('isScheduledAt')->willReturn($isScheduled);

        return $day;
    }
}
