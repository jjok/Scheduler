<?php

namespace jjok\Switches;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Time
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

    public function testTimeCanBeCreatedFromDateTime()
    {
        $time1 = Time::fromDateTime(\DateTimeImmutable::createFromFormat('H:i:s', '12:34:56'));
        $this->assertSame('12:34:56', $time1->toString());

        $time2 = Time::fromDateTime(\DateTimeImmutable::createFromFormat('H:i:s', '00:00:00'));
        $this->assertSame('00:00:00', $time2->toString());
    }

    public function testOneTimeCanBeforeAnother()
    {
        $time1 = Time::fromString('12:00:00');
        $time2 = Time::fromString('12:00:01');

        $this->assertTrue($time1->isBefore($time2));
    }

    public function testOneTimeCanBeAfterAnother()
    {
        $time1 = Time::fromString('12:00:01');
        $time2 = Time::fromString('12:00:00');

        $this->assertTrue($time1->isAfter($time2));
    }

    public function testEqualTimesAreNeitherBeforeOrAfterEachOther()
    {
        $time1 = Time::fromString('12:00:00');
        $time2 = Time::fromString('12:00:00');

        $this->assertFalse($time1->isBefore($time2));
        $this->assertFalse($time1->isAfter($time2));
    }

    /**
     * @uses \jjok\Switches\Period
     */
    public function testTimeIsNotDuringPeriodIfItIsBeforePeriodStart()
    {
        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));

        $time1 = Time::fromString('00:00:00');
        $time2 = Time::fromString('04:34:10');
        $time3 = Time::fromString('07:59:59');

        $this->assertTimeIsNotDuringPeriod($time1, $period);
        $this->assertTimeIsNotDuringPeriod($time2, $period);
        $this->assertTimeIsNotDuringPeriod($time3, $period);
    }

    /**
     * @uses \jjok\Switches\Period
     */
    public function testTimeIsDuringPeriodIfBetweenStartAndEnd() {
        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));

        $time1 = Time::fromString('08:00:00');
        $time2 = Time::fromString('08:34:01');
        $time3 = Time::fromString('08:59:59');
        $time4 = Time::fromString('09:00:00');

        $this->assertTimeIsDuringPeriod($time1, $period);
        $this->assertTimeIsDuringPeriod($time2, $period);
        $this->assertTimeIsDuringPeriod($time3, $period);
        $this->assertTimeIsDuringPeriod($time4, $period);
    }

    /**
     * @uses \jjok\Switches\Period
     */
    public function testTimeIsNotDuringPeriodIfItIsAfterPeriodEnd()
    {
        $period = new Period(Time::fromString('08:00:00'), Time::fromString('09:00:00'));

        $time1 = Time::fromString('09:00:01');
        $time2 = Time::fromString('12:00:00');
        $time3 = Time::fromString('23:59:59');

        $this->assertTimeIsNotDuringPeriod($time1, $period);
        $this->assertTimeIsNotDuringPeriod($time2, $period);
        $this->assertTimeIsNotDuringPeriod($time3, $period);
    }

    private function assertTimeIsDuringPeriod(Time $time, Period $period)
    {
        $this->assertTrue($time->isDuring($period));
    }

    private function assertTimeIsNotDuringPeriod(Time $time, Period $period)
    {
        $this->assertFalse($time->isDuring($period));
    }
}
