<?php

namespace jjok\Switches;

use DateTimeInterface as DateTime;

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

    public static function fromString(string $time) : Time
    {
        list($hour, $minutes, $seconds) = sscanf($time, '%u:%u:%u');

        return new static($hour, $minutes, $seconds);
    }

    public static function fromDateTime(DateTime $dateTime) : Time
    {
        return Time::fromString($dateTime->format('H:i:s'));
    }

    public function toString() : string
    {
        return sprintf(
            '%s:%s:%s',
            $this->intToTwoCharString($this->hour),
            $this->intToTwoCharString($this->minutes),
            $this->intToTwoCharString($this->seconds)
        );
    }

    private function intToTwoCharString(int $number) : string
    {
        return str_pad($number, 2, '0', \STR_PAD_LEFT);
    }

    public function isBefore(Time $other) : bool
    {
        return $this->toString() < $other->toString();
    }

    public function isAfter(Time $other) : bool
    {
        return $this->toString() > $other->toString();
    }

    public function isDuring(Period $period) : bool
    {
//        return $period->includes($this);
        return !$this->isBefore($period->getStart()) &&
               !$this->isAfter($period->getEnd());
    }
}
