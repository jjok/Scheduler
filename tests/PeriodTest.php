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
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('The start of a period must not be after the end.');

        new Period(Time::fromString('10:00:00'), Time::fromString('09:00:00'));
    }

    public function testTheStartAndEndOfAPeroidCanBeGot()
    {
        $start = Time::fromString('12:00:00');
        $end = Time::fromString('14:00:00');

        $period = new Period($start, $end);

        $this->assertSame($start, $period->getStart());
        $this->assertSame($end, $period->getEnd());
    }

//    public function testPeriodDoesNotIncludeTimesBeforeStart() {
//        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));
//
//        $this->assertPeriodDoesNotIncludeTime($period, '00:00:00');
//        $this->assertPeriodDoesNotIncludeTime($period, '04:34:10');
//        $this->assertPeriodDoesNotIncludeTime($period, '07:59:59');
//    }
//
//    public function testPeriodIncludesTimesFromStartToEnd() {
//        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));
//
//        $this->assertPeriodIncludesTime($period, '08:00:00');
//        $this->assertPeriodIncludesTime($period, '08:34:01');
//        $this->assertPeriodIncludesTime($period, '08:59:59');
//        $this->assertPeriodIncludesTime($period, '09:00:00');
//    }
//
//    public function testPeriodDoesNotIncludeTimesAfterEnd() {
//        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));
//
//        $this->assertPeriodDoesNotIncludeTime($period, '09:00:01');
//        $this->assertPeriodDoesNotIncludeTime($period, '12:00:00');
//        $this->assertPeriodDoesNotIncludeTime($period, '23:59:59');
//    }

//    private function assertPeriodIncludesTime(Period $period, string $time)
//    {
//        $this->assertTrue($period->includes(Time::fromString($time)));
//    }
//
//    private function assertPeriodDoesNotIncludeTime(Period $period, string $time)
//    {
//        $this->assertFalse($period->includes(Time::fromString($time)));
//    }
}
