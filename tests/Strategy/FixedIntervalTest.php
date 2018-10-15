<?php

namespace jjok\Switches\Strategy;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Strategy\FixedInterval
 */
final class FixedIntervalTest extends TestCase
{
    public function testSomething()
    {
        $strategy = new FixedInterval($this->interval('PT1M'), $this->interval('PT4M'), false);

        // Off for 4 minutes from now
        assertIsOffAt('now', $strategy);
        assertIsOffAt('+1 second', $strategy);
        assertIsOffAt('+2 minutes', $strategy);
        assertIsOffAt('+3 minutes, 59 seconds', $strategy);
        assertIsOnAt('+4 minutes, 1 second', $strategy);

        // On for 1 minute from now
        assertIsOnAt('now', $strategy);
        assertIsOnAt('+1 second', $strategy);
        assertIsOnAt('+59 seconds', $strategy);
        assertIsOffAt('+1 minute, 1 second', $strategy);

        // Off for 4 minutes from now
        assertIsOffAt('now', $strategy);
        assertIsOffAt('+1 second', $strategy);
        assertIsOffAt('+3 minutes, 59 seconds', $strategy);
        assertIsOnAt('+5 minutes', $strategy);

        // ...
    }

    public function testSomething2()
    {
        $strategy = new FixedInterval($this->interval('PT11H'), $this->interval('PT1H'), true);

        // On for 11 hours from now
        assertIsOnAt('now', $strategy);
        assertIsOnAt('+1 hour', $strategy);
        assertIsOnAt('+10 hours, 59 minutes', $strategy);
        assertIsOffAt('+11 hours, 1 second', $strategy);

        // Off for 1 hour from now
        assertIsOffAt('now', $strategy);
        assertIsOffAt('+2 minutes', $strategy);
        assertIsOffAt('+59 minutes, 59 seconds', $strategy);
        assertIsOnAt('+1 hour, 1 second', $strategy);

        // On for 11 hours from now
        assertIsOnAt('now', $strategy);
        assertIsOnAt('+1 second', $strategy);
        assertIsOnAt('+10 hours, 59 seconds', $strategy);
        assertIsOffAt('+11 hours, 1 second', $strategy);

        // ...
    }

    private function interval($spec) : \DateInterval
    {
        return new \DateInterval($spec);
    }
}
