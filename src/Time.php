<?php

namespace jjok\Switches;

use DateTimeInterface as DateTime;
use InvalidArgumentException;

final class Time
{
    private $hour;
    private $minutes;
    private $seconds;

    public static function fromDateTime(DateTime $dateTime) : Time
    {
        return self::fromString($dateTime->format('H:i:s'));
    }

    public static function fromString(string $time) : Time
    {
        [$hour, $minutes, $seconds] = sscanf($time, '%u:%u:%u');

        return new self($hour, $minutes, $seconds);
    }

    public function __construct(int $hour, int $minutes = 0, int $seconds = 0)
    {
        $this->assertHourIsValid($hour);
        $this->assertMinutesAreValid($minutes);
        $this->assertSecondsAreValid($seconds);

        $this->hour = $hour;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    private function assertHourIsValid(int $hour) : void
    {
        if($hour < 0 || $hour > 23) {
            throw new InvalidArgumentException('Hour must be between 0 and 23.');
        }
    }

    private function assertMinutesAreValid(int $minutes) : void
    {
        if($minutes < 0 || $minutes > 59) {
            throw new InvalidArgumentException('Minutes must be between 0 and 59.');
        }
    }

    private function assertSecondsAreValid(int $seconds) : void
    {
        if($seconds < 0 || $seconds > 59) {
            throw new InvalidArgumentException('Seconds must be between 0 and 59.');
        }
    }

    public function toString() : string
    {
        return sprintf('%02s:%02s:%02s', $this->hour, $this->minutes, $this->seconds);
    }

    public function isBefore(Time $that) : bool
    {
        return $this->toString() < $that->toString();
    }

    public function isAfter(Time $that) : bool
    {
        return $this->toString() > $that->toString();
    }

    public function isDuring(Period $period) : bool
    {
        return !$this->isBefore($period->start()) &&
               !$this->isAfter($period->end());
    }
}
