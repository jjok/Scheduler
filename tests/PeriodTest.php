<?php

namespace jjok\Switches;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Period
 * @uses \jjok\Switches\Time
 */
final class PeriodTest extends TestCase
{
    /**
     * @test
     */
    public function the_start_of_the_period_must_not_be_after_the_end()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('The start of a period must not be after the end.');

        Period::fromStrings('10:00:00', '09:00:00');
    }

    /**
     * @test
     */
    public function a_period_can_be_constructed_from_a_valid_start_and_end_time()
    {
        $start = Time::fromString('12:00:00');
        $end = Time::fromString('14:00:00');

        $period = new Period($start, $end);

        $this->assertSame($start, $period->start());
        $this->assertSame($end, $period->end());
    }
}
