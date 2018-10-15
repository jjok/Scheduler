<?php

namespace jjok\Switches;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Period
 * @uses \jjok\Switches\Time
 */
final class PeriodTest extends TestCase
{
    public function testExceptionIsThrownIfStartOfPeriodIsAfterEnd()
    {
        $start = Time::fromString('10:00:00');
        $end = Time::fromString('09:00:00');

        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('The start of a period must not be after the end.');

        new Period($start, $end);
    }

    public function testTheStartAndEndOfAPeriodCanBeGot()
    {
        $start = Time::fromString('12:00:00');
        $end = Time::fromString('14:00:00');

        $period = new Period($start, $end);

        $this->assertSame($start, $period->start());
        $this->assertSame($end, $period->end());
    }
}
