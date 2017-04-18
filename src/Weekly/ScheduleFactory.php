<?php

namespace jjok\Scheduler\Weekly;

use jjok\Scheduler\Period;
use jjok\Scheduler\Time;

final class ScheduleFactory
{
    public function create(array $config) : Schedule
    {
        $week = [];

        foreach ($config as $dayName => $periodValues) {
            $periods = array_map([$this, 'createPeriod'], $periodValues);

            if(!method_exists(DayOfWeek::class, $dayName)) {
                throw new \InvalidArgumentException(sprintf('%s is not a valid day.', $dayName));
            }

            $week[] = DayOfWeek::$dayName($periods);
        }

        return new Schedule($week);
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
