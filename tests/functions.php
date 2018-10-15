<?php

use jjok\Switches\SwitchStrategy;
use PHPUnit\Framework\Assert;

function assertIsOffAt(string $time, SwitchStrategy $strategy) : void
{
    Assert::assertFalse($strategy->isOnAt(new DateTimeImmutable($time)));
}

function assertIsOnAt(string $time, SwitchStrategy $strategy) : void
{
    Assert::assertTrue($strategy->isOnAt(new DateTimeImmutable($time)));
}
