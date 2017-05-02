<?php

namespace jjok\Scheduler;

use DateTimeInterface as DateTime;

interface Schedule
{
    /**
     * Find out if the schedule is scheduled (?) for the given time.
     */
    public function isOnAt(DateTime $dateTime) : bool;
}
