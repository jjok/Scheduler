<?php

namespace jjok\Switches\Strategy;

use DateTimeInterface as DateTime;
use jjok\Switches\Period;
use jjok\Switches\SwitchStrategy;
use jjok\Switches\Time;

final class DailySchedule implements SwitchStrategy
{
    /**
     * @var Period[]
     */
    private $periods = [];

    public function __construct(array $periods)
    {
        foreach($periods as $period) {
            $this->addPeriod($period);
        }
    }

    private function addPeriod(Period $period)
    {
        $this->periods[] = $period;
    }

    public function isOnAt(DateTime $dateTime) : bool
    {
        $time = Time::fromDateTime($dateTime);

        foreach ($this->periods as $period) {
//            if($period->includes($time)) {
            if($time->isDuring($period)) {
                return true;
            }
        }

        return false;
    }
}
