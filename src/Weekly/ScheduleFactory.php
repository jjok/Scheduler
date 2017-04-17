<?php

namespace jjok\Scheduler\Weekly;

use jjok\Scheduler\Period;
use jjok\Scheduler\Time;

final class ScheduleFactory
{
    public function create(array $configDays)
    {
        $week = [];

        foreach ($configDays as $dayName => $period_values) {
            $periods = array_map([$this, 'createPeriod'], $period_values);

            $week[] = DayOfWeek::$dayName($periods);
        }

        return new Schedule($week);
    }

    private function createPeriod(string $times) {
        list($start, $end) = sscanf($times, '%s - %s');

        return new Period(Time::fromString($start), Time::fromString($end));
    }
}
