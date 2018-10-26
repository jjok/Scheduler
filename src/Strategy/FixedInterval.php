<?php

namespace jjok\Switches\Strategy;

use DateInterval as Interval;
use DateTimeInterface as DateTime;
use jjok\Switches\SwitchStrategy;

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
        $this->setStatus($initial);
    }

    public function shouldBeOnAt(DateTime $dateTime) : bool
    {
        $interval = $this->status ? $this->onFor : $this->offFor;

        if($this->statusChangedAt->add($interval) < $dateTime) {
            $this->setStatus(!$this->status);
        }

        return $this->status;
    }

    private function setStatus(int $status)
    {
        $this->status = $status;
        $this->logTime();
    }

    private function logTime()
    {
        $this->statusChangedAt = new \DateTimeImmutable();
    }
}
