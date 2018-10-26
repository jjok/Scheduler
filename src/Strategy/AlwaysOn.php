<?php

namespace jjok\Switches\Strategy;

use DateTimeInterface as DateTime;
use jjok\Switches\SwitchStrategy;

final class AlwaysOn implements SwitchStrategy
{
    public function shouldBeOnAt(DateTime $dateTime): bool
    {
        return true;
    }
}
