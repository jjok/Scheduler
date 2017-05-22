<?php

namespace jjok\Switches;

interface ScheduleFactory
{
    /**
     * Create a schedule from a configuration.
     * @param array $config
     * @return SwitchStrategy
     */
    public function create(array $config) : SwitchStrategy;
}
