<?php

namespace jjok\Scheduler;

interface ScheduleFactory
{
    /**
     * Create a schedule from a configuration.
     * @param array $config
     * @return Schedule
     */
    public function create(array $config) : Schedule;
}
