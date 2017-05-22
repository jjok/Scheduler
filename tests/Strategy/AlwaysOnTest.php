<?php

namespace jjok\Switches\Strategy;

/**
 * @covers \jjok\Switches\Strategy\AlwaysOn
 */
final class AlwaysOnTest extends AbstractStrategyTest
{
    public function testAlwaysOnIsAlwaysOn()
    {
        $strategy = new AlwaysOn();

        $this->assertIsOnAt('tomorrow', $strategy);
        $this->assertIsOnAt('+12 hours', $strategy);
        $this->assertIsOnAt('+5 minutes', $strategy);
        $this->assertIsOnAt('now', $strategy);
        $this->assertIsOnAt('5 minutes ago', $strategy);
        $this->assertIsOnAt('50 minutes ago', $strategy);
        $this->assertIsOnAt('3 hours ago', $strategy);
        $this->assertIsOnAt('yesterday', $strategy);
    }
}
