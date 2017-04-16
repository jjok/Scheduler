<?php

namespace jjok\Scheduler;

final class Period
{
    private $start;
    private $end;

    public function __construct($start, $end)
    {
        if($start > $end) {
            throw new \InvalidArgumentException('The start of a period must not be after the end.');
        }

        $this->start = $start;
        $this->end = $end;
    }

    public function someTimeIsDuringThis($time)
    {
        return $time > $this->start &&
               $time < $this->end;
    }
}