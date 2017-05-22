<?php

namespace jjok\Switches\Strategy;

use jjok\Switches\SwitchStrategy;
use PHPUnit\Framework\TestCase;

abstract class AbstractStrategyTest extends TestCase
{
    protected function assertIsOffAt(string $time, SwitchStrategy $strategy)
    {
        $this->assertFalse($strategy->isOnAt(new \DateTimeImmutable($time)));
    }

    protected function assertIsOnAt(string $time, SwitchStrategy $strategy)
    {
        $this->assertTrue($strategy->isOnAt(new \DateTimeImmutable($time)));
    }
}
