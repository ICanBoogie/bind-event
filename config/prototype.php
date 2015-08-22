<?php

namespace ICanBoogie\Binding\Event;

use ICanBoogie;

$hooks = Hooks::class . '::';

return [

	ICanBoogie\Core::class . '::lazy_get_events' => $hooks . 'get_events'

];
