<?php

namespace jjok\Switches\Strategy;

use DateTimeInterface as DateTime;
use jjok\Switches\Period;
use jjok\Switches\SwitchStrategy;
use jjok\Switches\Time;

final class DailySchedule implements SwitchStrategy
{
    /** @var Period[] */
    private $periods;

    public function __construct(Period ... $periods)
    {
        $this->periods = $periods;
    }

    public function shouldBeOnAt(DateTime $dateTime) : bool
    {
        $time = Time::fromDateTime($dateTime);

        foreach ($this->periods as $period) {
            if($time->isDuring($period)) {
                return true;
            }
        }

        return false;
    }
}
