<?php

namespace jjok\Switches\Strategy;

/**
 * @covers \jjok\Switches\Strategy\FixedInterval
 */
final class FixedIntervalTest extends AbstractStrategyTest
{
    public function testSomething()
    {
        $strategy = new FixedInterval($this->interval('PT1M'), $this->interval('PT4M'), false);

        // Off for 4 minutes from now
        $this->assertIsOffAt('now', $strategy);
        $this->assertIsOffAt('+1 second', $strategy);
        $this->assertIsOffAt('+2 minutes', $strategy);
        $this->assertIsOffAt('+4 minutes', $strategy);
        $this->assertIsOnAt('+4 minutes, 1 second', $strategy);

        // On for 1 minute from now
        $this->assertIsOnAt('now', $strategy);
        $this->assertIsOnAt('+1 second', $strategy);
        $this->assertIsOnAt('+1 minute', $strategy);
        $this->assertIsOffAt('+1 minute, 1 second', $strategy);

        // Off for 4 minutes from now
        $this->assertIsOffAt('now', $strategy);
        $this->assertIsOffAt('+1 second', $strategy);
        $this->assertIsOffAt('+3 minutes, 59 seconds', $strategy);
        $this->assertIsOnAt('+5 minutes', $strategy);

        // ...
    }

    public function testSomething2()
    {
        $strategy = new FixedInterval($this->interval('PT11H'), $this->interval('PT1H'), true);

        // On for 11 hours from now
        $this->assertIsOnAt('now', $strategy);
        $this->assertIsOnAt('+1 hour', $strategy);
        $this->assertIsOnAt('+10 hours', $strategy);
        $this->assertIsOffAt('+11 hours, 1 second', $strategy);

        // Off for 1 hour from now
        $this->assertIsOffAt('now', $strategy);
        $this->assertIsOffAt('+2 minutes', $strategy);
        $this->assertIsOffAt('+59 minutes, 59 seconds', $strategy);
        $this->assertIsOnAt('+1 hour, 1 second', $strategy);

        // On for 11 hours from now
        $this->assertIsOnAt('now', $strategy);
        $this->assertIsOnAt('+1 second', $strategy);
        $this->assertIsOnAt('+11 hours', $strategy);
        $this->assertIsOffAt('+11 hours, 1 second', $strategy);

        // ...
    }

    private function interval($spec) {
        return new \DateInterval($spec);
    }
}
