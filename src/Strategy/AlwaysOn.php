<?php

namespace jjok\Scheduler\Strategy;

use DateTimeInterface as DateTime;
use jjok\Scheduler\SwitchStrategy;

final class AlwaysOn implements SwitchStrategy
{
    public function isOnAt(DateTime $dateTime): bool
    {
        return true;
    }
}
