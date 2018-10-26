<?php

namespace jjok\Switches\Strategy;

use PHPUnit\Framework\TestCase;

/**
 * @covers \jjok\Switches\Strategy\AlwaysOff
 */
final class AlwaysOffTest extends TestCase
{
    /**
     * @test
     * @dataProvider timeProvider
     */
    public function it_is_always_off(string $time)
    {
        $strategy = new AlwaysOff();

        assertShouldBeOffAt($time, $strategy);
    }

    public function timeProvider() : array
    {
        return [
            ['tomorrow'      ],
            ['+12 hours'     ],
            ['+5 minutes'    ],
            ['now'           ],
            ['5 minutes ago' ],
            ['50 minutes ago'],
            ['3 hours ago'   ],
            ['yesterday'     ],
        ];
    }
}
