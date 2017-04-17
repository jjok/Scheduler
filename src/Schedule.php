<?php

namespace jjok\Scheduler;

use DateTime;

interface Schedule
{
    /**
     * @param DateTime $dateTime
     * @return bool
     */
    public function isOnAt(DateTime $dateTime) : bool;
}
