<?php

use jjok\Switches\SwitchStrategy;
use PHPUnit\Framework\Assert;

function assertShouldBeOffAt(string $time, SwitchStrategy $strategy) : void
{
    Assert::assertFalse($strategy->shouldBeOnAt(new DateTimeImmutable($time)));
}

function assertShouldBeOnAt(string $time, SwitchStrategy $strategy) : void
{
    Assert::assertTrue($strategy->shouldBeOnAt(new DateTimeImmutable($time)));
}
