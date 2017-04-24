<?php

namespace jjok\Scheduler;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Scheduler\Time
 */
final class TimeTest extends TestCase
{
    public function testHourMustBeValid()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Hour must be between 0 and 23.');

        new Time(24);
    }

    public function testHourMustNotBeNegative()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Hour must be between 0 and 23.');

        new Time(-1);
    }

    public function testMinutesMustBeValid()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Minutes must be between 0 and 59.');

        new Time(10, 60);
    }

    public function testMinutesMustNotBeNegative()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Minutes must be between 0 and 59.');

        new Time(10, -1);
    }

    public function testSecondsMustBeValid()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Seconds must be between 0 and 59.');

        new Time(10, 30, 60);
    }

    public function testSecondsMustNotBeNegative()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('Seconds must be between 0 and 59.');

        new Time(10, 30, -1);
    }

    public function testHourMustBeSet()
    {
        $time = new Time(9);

        $this->assertSame('09:00:00', $time->toString());
    }

    public function testMinutesMayBeSet()
    {
        $time = new Time(12, 06);

        $this->assertSame('12:06:00', $time->toString());
    }

    public function testSecondsMayBeSet()
    {
        $time = new Time(23, 59, 04);

        $this->assertSame('23:59:04', $time->toString());
    }

    public function testTimeCanBeCreatedFromString()
    {
        $time1 = Time::fromString('12:34:56');
        $this->assertSame('12:34:56', $time1->toString());

        $time2 = Time::fromString('01:04:06');
        $this->assertSame('01:04:06', $time2->toString());
    }
}
