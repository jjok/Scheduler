<?php

namespace jjok\Scheduler;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Scheduler\Period
 * @uses \jjok\Scheduler\Time
 */
final class PeriodTest extends TestCase
{
    public function testExceptionIsThrownIfStartOfPeriodIsAfterEnd()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('The start of a period must not be after the end.');

        new Period(Time::fromString('10:00:00'), Time::fromString('09:00:00'));
    }

    public function testPeriodDoesNotIncludeTimesBeforeStart() {
        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));

        $this->assertFalse($period->includes(Time::fromString('00:00:00')));
        $this->assertFalse($period->includes(Time::fromString('04:34:10')));
        $this->assertFalse($period->includes(Time::fromString('07:59:59')));
    }

    public function testPeriodIncludesTimesBetweenStartToEnd() {
        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));

        $this->assertTrue($period->includes(Time::fromString('08:00:00')));
        $this->assertTrue($period->includes(Time::fromString('08:34:01')));
        $this->assertTrue($period->includes(Time::fromString('08:59:59')));
    }

    public function testPeriodDoesNotIncludeTimesAfterEnd() {
        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));

        $this->assertFalse($period->includes(Time::fromString('09:00:00')));
        $this->assertFalse($period->includes(Time::fromString('09:00:01')));
        $this->assertFalse($period->includes(Time::fromString('23:59:59')));
    }
}
