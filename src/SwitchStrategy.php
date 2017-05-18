<?php

namespace jjok\Scheduler;

use DateTimeInterface as DateTime;

interface SwitchStrategy
{
    /**
     * Find out if the switch should be on at the given time.
     */
    public function isOnAt(DateTime $dateTime) : bool;
}
