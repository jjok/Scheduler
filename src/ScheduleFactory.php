<?php

namespace jjok\Scheduler;

interface ScheduleFactory
{
    /**
     * Create a schedule from a configuration.
     * @param array $config
     * @return SwitchStrategy
     */
    public function create(array $config) : SwitchStrategy;
}
