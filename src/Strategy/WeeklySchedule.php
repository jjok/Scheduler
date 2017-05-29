<?php

namespace jjok\Switches\Strategy;

use DateTimeInterface as DateTime;
use jjok\Switches\SwitchStrategy;
use jjok\Switches\Time;
use jjok\Switches\Weekly\DayOfWeek;

final class WeeklySchedule implements SwitchStrategy
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
        $dayOfWeek = $dateTime->format('N');
        $time = Time::fromDateTime($dateTime);

        foreach ($this->days as $day) {
            if($day->isScheduledAt($dayOfWeek, $time)) {
                return true;
            }
        }

        return false;
    }
}
