<?php

namespace jjok\Switches\Strategy;

use DateTimeInterface as DateTime;
use jjok\Switches\SwitchStrategy;

final class Collection implements SwitchStrategy
{
    /**
     * @var SwitchStrategy[]
     */
    private $strategies;

    /**
     * @var SwitchStrategy
     */
    private $currentStrategy;

    public function __construct(array $strategies)
    {
        $currentStrategy = key($strategies);
        if($currentStrategy === null) {
            throw new \InvalidArgumentException('At least one strategy must be added.');
        }

        $this->strategies = $strategies;

        $this->use($currentStrategy);
    }

    public function use(string $strategyName) : void
    {
        $this->currentStrategy = $this->getStrategyByName($strategyName);
    }

    public function isOnAt(DateTime $dateTime): bool
    {
        return $this->currentStrategy->isOnAt($dateTime);
    }

    private function getStrategyByName(string $strategyName) : SwitchStrategy
    {
        if(!isset($this->strategies[$strategyName])) {
            throw new \InvalidArgumentException(sprintf('Unknown strategy "%s"', $strategyName));
        }

        return $this->strategies[$strategyName];
    }
}
