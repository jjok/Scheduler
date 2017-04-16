<?php

namespace jjok\Scheduler;

final class Time
{
    private $hour;
    private $minutes;
    private $seconds;

    public function __construct(int $hour, int $minutes = 0, int $seconds = 0)
    {
        if($hour < 0 || $hour > 23) {
            throw new \InvalidArgumentException('Hour must be between 0 and 23.');
        }

        if($minutes < 0 || $minutes > 59) {
            throw new \InvalidArgumentException('Minutes must be between 0 and 59.');
        }

        if($seconds < 0 || $seconds > 59) {
            throw new \InvalidArgumentException('Seconds must be between 0 and 59.');
        }

        $this->hour = $hour;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    public static function fromString($time) : Time
    {
        list($hour, $minutes, $seconds) = sscanf($time, '%u:%u:%u');

        return new static($hour, $minutes, $seconds);
    }

    public function __toString()
    {
        return sprintf('%u:%u:%u', $this->hour, $this->minutes, $this->seconds);
    }
}
