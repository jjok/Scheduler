<?php

namespace jjok\Switches\Strategy;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Strategy\AlwaysOff
 */
final class AlwaysOffTest extends TestCase
{
    public function testAlwaysOffIsAlwaysOff()
    {
        $strategy = new AlwaysOff();

        $this->assertIsOffAt('tomorrow', $strategy);
        $this->assertIsOffAt('+12 hours', $strategy);
        $this->assertIsOffAt('+5 minutes', $strategy);
        $this->assertIsOffAt('now', $strategy);
        $this->assertIsOffAt('5 minutes ago', $strategy);
        $this->assertIsOffAt('50 minutes ago', $strategy);
        $this->assertIsOffAt('3 hours ago', $strategy);
        $this->assertIsOffAt('yesterday', $strategy);
    }

    private function assertIsOffAt(string $time, AlwaysOff $strategy)
    {
        $this->assertFalse($strategy->isOnAt(new \DateTimeImmutable($time)));
    }
}
