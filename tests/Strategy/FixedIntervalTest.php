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
        assertShouldBeOffAt('now', $strategy);
        assertShouldBeOffAt('+1 second', $strategy);
        assertShouldBeOffAt('+2 minutes', $strategy);
        assertShouldBeOffAt('+3 minutes, 59 seconds', $strategy);
        assertShouldBeOnAt('+4 minutes, 1 second', $strategy);

        // On for 1 minute from now
        assertShouldBeOnAt('now', $strategy);
        assertShouldBeOnAt('+1 second', $strategy);
        assertShouldBeOnAt('+59 seconds', $strategy);
        assertShouldBeOffAt('+1 minute, 1 second', $strategy);

        // Off for 4 minutes from now
        assertShouldBeOffAt('now', $strategy);
        assertShouldBeOffAt('+1 second', $strategy);
        assertShouldBeOffAt('+3 minutes, 59 seconds', $strategy);
        assertShouldBeOnAt('+5 minutes', $strategy);

        // ...
    }

    public function testSomething2()
    {
        $strategy = new FixedInterval($this->interval('PT11H'), $this->interval('PT1H'), true);

        // On for 11 hours from now
        assertShouldBeOnAt('now', $strategy);
        assertShouldBeOnAt('+1 hour', $strategy);
        assertShouldBeOnAt('+10 hours, 59 minutes', $strategy);
        assertShouldBeOffAt('+11 hours, 1 second', $strategy);

        // Off for 1 hour from now
        assertShouldBeOffAt('now', $strategy);
        assertShouldBeOffAt('+2 minutes', $strategy);
        assertShouldBeOffAt('+59 minutes, 59 seconds', $strategy);
        assertShouldBeOnAt('+1 hour, 1 second', $strategy);

        // On for 11 hours from now
        assertShouldBeOnAt('now', $strategy);
        assertShouldBeOnAt('+1 second', $strategy);
        assertShouldBeOnAt('+10 hours, 59 seconds', $strategy);
        assertShouldBeOffAt('+11 hours, 1 second', $strategy);

        // ...
    }

    private function interval($spec) : \DateInterval
    {
        return new \DateInterval($spec);
    }
}
