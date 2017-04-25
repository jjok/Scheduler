<?php

namespace jjok\Scheduler\Weekly;

use DateTime;
use jjok\Scheduler\Schedule as Test;
use jjok\Scheduler\Time;

final class Schedule implements Test
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
        $time = Time::fromString($dateTime->format('H:i:s'));

        foreach ($this->days as $day) {
            if($day->isScheduledAt($day_of_week, $time)) {
                return true;
            }
        }

        return false;
    }
}
