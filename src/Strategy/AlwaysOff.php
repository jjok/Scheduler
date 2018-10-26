<?php

namespace jjok\Switches\Strategy;

use DateTimeInterface as DateTime;
use jjok\Switches\SwitchStrategy;

final class AlwaysOff implements SwitchStrategy
{
    public function shouldBeOnAt(DateTime $dateTime): bool
    {
        return false;
    }
}
