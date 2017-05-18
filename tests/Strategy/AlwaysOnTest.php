<?php

namespace jjok\Scheduler\Strategy;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Scheduler\Strategy\AlwaysOn
 */
final class AlwaysOnTest extends TestCase
{
    public function testAlwaysOnIsAlwaysOn()
    {
        $strategy = new AlwaysOn();

        $this->assertIsOffAt('tomorrow', $strategy);
        $this->assertIsOffAt('+12 hours', $strategy);
        $this->assertIsOffAt('+5 minutes', $strategy);
        $this->assertIsOffAt('now', $strategy);
        $this->assertIsOffAt('5 minutes ago', $strategy);
        $this->assertIsOffAt('50 minutes ago', $strategy);
        $this->assertIsOffAt('3 hours ago', $strategy);
        $this->assertIsOffAt('yesterday', $strategy);
    }

    private function assertIsOffAt(string $time, AlwaysOn $strategy)
    {
        $this->assertTrue($strategy->isOnAt(new \DateTimeImmutable($time)));
    }
}
