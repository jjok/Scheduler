<?php

namespace jjok\Scheduler;

final class Day
{
    private $periods;

    public function __construct(array $periods)
    {
        $this->periods = array_map(function(Period $period) {
            return $period;
        }, $periods);
    }

    public function hasAPeriodThatIsNow() {
        //TODO
        return true;
    }
}
