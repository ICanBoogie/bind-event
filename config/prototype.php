<?php

use ICanBoogie\Application;
use ICanBoogie\Binding\Event\Hooks;
use ICanBoogie\Binding\Prototype\ConfigBuilder;

return fn(ConfigBuilder $config) => $config
	->bind(Application::class, 'lazy_get_events', [ Hooks::class, 'get_events']);
