<?php

namespace ICanBoogie\Binding\Event;

$hooks = Hooks::class . '::';

return [

	'prototypes' => [

		'ICanBoogie\Core::lazy_get_events' => $hooks . 'get_events'

	]

];
