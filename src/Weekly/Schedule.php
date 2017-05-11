<?php

namespace jjok\Scheduler\Weekly;

use DateTimeInterface as DateTime;
use jjok\Scheduler\Schedule as ScheduleStrategy;
use jjok\Scheduler\Time;

final class Schedule implements ScheduleStrategy
{
    /**
     * @var DayOfWeek[]
     */
    private $days = [];

    /**
     * @param DayOfWeek[] $days
     */
    public function __construct(array $days)
    {
        foreach($days as $day) {
            $this->addDay($day);
        }
    }

    private function addDay(DayOfWeek $day)
    {
        //TODO Some validation. Don't add same day twice
//        foreach ($this->days as $current_day) {
//
//        }

        $this->days[] = $day;
    }

    public function isOnAt(DateTime $dateTime) : bool
    {
        $day_of_week = $dateTime->format('N');
        $time = Time::fromDateTime($dateTime);

        foreach ($this->days as $day) {
            if($day->isScheduledAt($day_of_week, $time)) {
                return true;
            }
        }

        return false;
    }
}
