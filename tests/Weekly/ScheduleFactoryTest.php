<?php

namespace jjok\Scheduler\Weekly;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Scheduler\Weekly\ScheduleFactory
 * @uses \jjok\Scheduler\Period
 * @uses \jjok\Scheduler\Time
 * @uses \jjok\Scheduler\Weekly\Schedule
 */
final class ScheduleFactoryTest extends TestCase
{
    public function testPeriodsMustBeAssignedToAValidDay()
    {
        $factory = new ScheduleFactory();

        $config = array(
            'Blunsday' => [
                '12:00:00 - 13:00:00',
            ]
        );

        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Blunsday is not a valid day.');
        $factory->create($config);
    }

    public function testPeriodsMustBeCorrectlyFormatted() {
        $factory = new ScheduleFactory();

        $config = array(
            'Monday' => [
                '12:00:00-13:00:00',
            ]
        );

        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Period must be in the format "HH:MM:SS - HH:MM:SS".');
        $factory->create($config);
    }

    public function testScheduleCanBeCreatedFromValidConfigArray() {
        $factory = new ScheduleFactory();

        $config = array(
            'Monday' => [
                '12:00:00 - 13:00:00',
            ],
            'Sunday' => [
                '01:00:00 - 01:30:00',
            ],
        );

        $schedule = $factory->create($config);

        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertTrue($schedule->isOnAt($this->createDateTime('2017-04-17 12:00:00')));
        $this->assertFalse($schedule->isOnAt($this->createDateTime('2017-04-17 13:00:01')));
        $this->assertTrue($schedule->isOnAt($this->createDateTime('2017-04-23 01:00:00')));
        $this->assertFalse($schedule->isOnAt($this->createDateTime('2017-04-23 01:30:01')));
    }

    private function createDateTime(string $time)
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s', $time);
    }
}
