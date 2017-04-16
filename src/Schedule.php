<?php

namespace jjok\Scheduler;

use DateTime;

interface Schedule
{
    public function isOnAt(DateTime $dateTime) : bool;
}
