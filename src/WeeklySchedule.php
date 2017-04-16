<?php

namespace jjok\Scheduler;

use DateTime;

final class WeeklySchedule implements Schedule
{
    /**
     * @var Day[]
     */
    private $days;

    /**
     * @param Day[] $days
     */
    public function __construct(array $days)
    {
        foreach($days as $day) {
            $this->addDay($day);
        }
    }

    private function addDay(Day $day)
    {
        //TODO Some validation. Don't add same day twice
        $this->days[] = $day;
    }

    public function isOnAt(DateTime $dateTime) : bool
    {
        $day_of_week = $dateTime->format('N');
        $time = Time::fromString($dateTime->format('H:i:s'));
        foreach ($this->days as $day) {
            if($day->hasAPeriodThatIsNow($day_of_week, $time)) {
                return true;
            }
        }

        return false;
    }
}
