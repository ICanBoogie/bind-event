<?php

namespace ICanBoogie\Binding\Event;

use Test\ICanBoogie\Binding\Event\SampleEvent;
use Test\ICanBoogie\Binding\Event\SampleListener;

return fn(ConfigBuilder $config) => $config
    ->attach(SampleEvent::class, [ SampleListener::class, 'on_event' ]);
