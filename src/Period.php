<?php

namespace jjok\Switches;

/**
 * A period of time.
 */
final class Period
{
    private $start;
    private $end;

    public function __construct(Time $start, Time $end)
    {
        $this->assertStartIsBeforeEnd($start, $end);

        $this->start = $start;
        $this->end = $end;
    }

    private function assertStartIsBeforeEnd(Time $start, Time $end) : void
    {
        if($start->isAfter($end)) {
            throw new \InvalidArgumentException('The start of a period must not be after the end.');
        }
    }

    public function start() : Time
    {
        return $this->start;
    }

    public function end() : Time
    {
        return $this->end;
    }
}
