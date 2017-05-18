<?php

namespace jjok\Scheduler\Strategy;

use DateInterval as Interval;
use DateTimeInterface as DateTime;
use jjok\Scheduler\SwitchStrategy;

final class FixedInterval implements SwitchStrategy
{
    private $onFor;
    private $offFor;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var \DateTimeImmutable
     */
    private $statusChangedAt;

    public function __construct(Interval $onFor, Interval $offFor, bool $initial)
    {
        $this->onFor = $onFor;
        $this->offFor = $offFor;
        $this->status = $initial;
        $this->logTime();
    }

    public function isOnAt(DateTime $dateTime) : bool
    {
        $interval = $this->status ? $this->onFor : $this->offFor;

        if($this->statusChangedAt->add($interval) < $dateTime) {
            $this->status = !$this->status;
            $this->logTime();
        }

        return $this->status;
    }

    private function logTime()
    {
        $this->statusChangedAt = new \DateTimeImmutable();
    }
}
