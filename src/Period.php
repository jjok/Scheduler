<?php

namespace jjok\Scheduler;

/**
 * A period of time.
 */
class Period
{
    private $start;
    private $end;

    public function __construct(Time $start, Time $end)
    {
        if($start > $end) {
            throw new \InvalidArgumentException('The start of a period must not be after the end.');
        }

        $this->start = $start;
        $this->end = $end;
    }

//    public function getStart() {
//        return $this->start;
//    }
//
//    public function getEnd() {
//        return $this->end;
//    }

    public function includes(Time $time)
    {
        return !$time->isBefore($this->start) &&
               !$time->isAfter($this->end);
    }
}
