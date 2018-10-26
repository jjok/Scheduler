<?php

namespace jjok\Switches;

use DateTimeInterface as DateTime;

interface SwitchStrategy
{
    /**
     * Find out if the switch should be on at the given time.
     */
    public function shouldBeOnAt(DateTime $dateTime) : bool;
}
