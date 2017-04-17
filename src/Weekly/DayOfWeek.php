<?php

namespace jjok\Scheduler\Weekly;

use jjok\Scheduler\Period;
use jjok\Scheduler\Time;

final class DayOfWeek
{
    /**
     * @var int
     */
    private $day;

    /**
     * @var Period[]
     */
    private $periods;

    /**
     * @param int $day
     * @param Period[] $periods
     */
    private function __construct(int $day, array $periods)
    {
        $this->day = $day;

        $this->periods = array_map(function(Period $period) {
            return $period;
        }, $periods);
    }

    public static function Monday(array $periods)
    {
        return new static(1, $periods);
    }

    public static function Tuesday(array $periods)
    {
        return new static(2, $periods);
    }

    public static function Wednesday(array $periods)
    {
        return new static(3, $periods);
    }

    public static function Thursday(array $periods)
    {
        return new static(4, $periods);
    }

    public static function Friday(array $periods)
    {
        return new static(5, $periods);
    }

    public static function Saturday(array $periods)
    {
        return new static(6, $periods);
    }

    public static function Sunday(array $periods)
    {
        return new static(7, $periods);
    }

    /**
     * @todo Name this something better
     */
    public function hasAPeriodThatIsNow(int $day, Time $time) : bool
    {
        if($day !== $this->day) {
            false;
        }

        foreach ($this->periods as $period) {
//            if($time->isDuring($period)) {
            if($period->includes($time)) {
                return true;
            }
        }

        return false;
    }

//    public function toInt() {
//        return $this->day;
//    }
}
