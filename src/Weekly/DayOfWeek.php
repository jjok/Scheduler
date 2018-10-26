<?php

namespace jjok\Switches\Weekly;

use jjok\Switches\Period;
use jjok\Switches\Time;

final class DayOfWeek
{
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 7;

    /**
     * @var int
     */
    private $day;

    /**
     * @var Period[]
     */
    private $periods;

    public static function Monday(array $periods)
    {
        return new static(static::MONDAY, $periods);
    }

    public static function Tuesday(array $periods)
    {
        return new static(static::TUESDAY, $periods);
    }

    public static function Wednesday(array $periods)
    {
        return new static(static::WEDNESDAY, $periods);
    }

    public static function Thursday(array $periods)
    {
        return new static(static::THURSDAY, $periods);
    }

    public static function Friday(array $periods)
    {
        return new static(static::FRIDAY, $periods);
    }

    public static function Saturday(array $periods)
    {
        return new static(static::SATURDAY, $periods);
    }

    public static function Sunday(array $periods)
    {
        return new static(static::SUNDAY, $periods);
    }

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

    /**
     * @todo Name this something better
     */
    public function isScheduledAt(int $day, Time $time) : bool
    {
        if($day !== $this->day) {
            return false;
        }

        foreach ($this->periods as $period) {
            if($time->isDuring($period)) {
                return true;
            }
        }

        return false;
    }
}
