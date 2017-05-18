<?php

namespace jjok\Scheduler\Weekly;

use jjok\Scheduler\Period;
use jjok\Scheduler\Strategy\WeeklySchedule;
use jjok\Scheduler\SwitchStrategy as ScheduleStrategy;
use jjok\Scheduler\Time;

final class ScheduleFactory implements \jjok\Scheduler\ScheduleFactory
{
    public function create(array $config) : ScheduleStrategy
    {
        $week = [];

        foreach ($config as $dayName => $periodValues) {
            if(!method_exists(DayOfWeek::class, $dayName)) {
                throw new \InvalidArgumentException(sprintf('%s is not a valid day.', $dayName));
            }

            $periods = array_map([$this, 'createPeriod'], $periodValues);

            $week[] = DayOfWeek::$dayName($periods);
        }

        return new WeeklySchedule($week);
    }

    private function createPeriod(string $times) : Period
    {
        list($start, $end) = sscanf($times, '%s - %s');

        if(empty($start) || empty($end)) {
            throw new \InvalidArgumentException('Period must be in the format "HH:MM:SS - HH:MM:SS".');
        }

        return new Period(Time::fromString($start), Time::fromString($end));
    }
}
