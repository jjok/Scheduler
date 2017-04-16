<?php

namespace jjok\Scheduler;

final class WeeklySchedule implements Schedule
{
    /**
     * @var Day[]
     */
    private $days;

    /**
     * WeeklySchedule constructor.
     * @param Day[] $days
     */
    public function __construct(array $days)
    {
        foreach($days as $day) {
            $this->addDay($day);
        }
    }

    private function addDay(Day $day) {
        //TODO Some validation. Don't add same day twice
        $this->days[] = $day;
    }

    public function isItOn()
    {
        foreach ($this->days as $day) {
            if($day->hasAPeriodThatIsNow()) {
                return true;
            }
        }

        return false;
    }
}
