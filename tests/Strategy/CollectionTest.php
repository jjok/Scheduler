<?php

namespace jjok\Switches\Strategy;

use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    /**
     * @test
     */
    public function at_least_one_strategy_must_be_added()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('At least one strategy must be added');

        new Collection([]);
    }

    /**
     * @test
     * @dataProvider defaultStrategyProvider
     */
    public function the_first_strategy_is_used_by_default(array $strategies, $shouldBeOn)
    {
        $strategy = new Collection($strategies);

        $time = new \DateTimeImmutable();

        $isOn = $strategy->shouldBeOnAt($time);

        $this->assertSame($shouldBeOn, $isOn);
    }

    public function defaultStrategyProvider() : array
    {
        return [
            [[
                'Strategy1' => new AlwaysOn(),
                'Strategy2' => new AlwaysOff(),
                'Strategy3' => new AlwaysOff()
            ], true],
            [[
                'Strategy1' => new AlwaysOff(),
                'Strategy2' => new AlwaysOn(),
                'Strategy3' => new AlwaysOn(),
             ], false],
        ];
    }

    /**
     * @test
     */
    public function its_state_is_based_on_the_state_of_the_currently_selected_strategy()
    {
        $strategy = new Collection([
            'Strategy1' => new AlwaysOn(),
            'Strategy2' => new AlwaysOff(),
            'Strategy3' => new AlwaysOff(),
            'Strategy4' => new AlwaysOn(),
        ]);

        $time = new \DateTimeImmutable('2018-10-25 22:46:00');

        $this->assertTrue($strategy->shouldBeOnAt($time));

        $strategy->use('Strategy2');
        $this->assertFalse($strategy->shouldBeOnAt($time));

        $strategy->use('Strategy4');
        $this->assertTrue($strategy->shouldBeOnAt($time));

        $strategy->use('Strategy3');
        $this->assertFalse($strategy->shouldBeOnAt($time));

        $strategy->use('Strategy1');
        $this->assertTrue($strategy->shouldBeOnAt($time));
    }

    /**
     * @test
     * @dataProvider missingStrategyNames
     */
    public function trying_to_use_a_strategy_that_does_not_exists_throws_an_error(string $missingStrategy)
    {
        $strategy = new Collection([
            'Strategy1' => new AlwaysOn(),
            'Strategy3' => new AlwaysOff(),
        ]);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown strategy');

        $strategy->use($missingStrategy);
    }

    public function missingStrategyNames() : array
    {
        return [
            ['Strategy2'],
            ['Strategy4'],
        ];
    }
}
