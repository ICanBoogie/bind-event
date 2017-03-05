<?php

/*
 * This file is part of the ICanBoogie package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ICanBoogie\Binding\Event;

use ICanBoogie\Application;
use ICanBoogie\EventCollection;
use ICanBoogie\EventCollectionProvider;

class Hooks
{
	/**
	 * Returns an {@link EventCollection} instance created with the hooks from the `events` config.
	 *
	 * @param Application $app
	 *
	 * @return EventCollection
	 */
	static public function get_events(Application $app)
	{
		static $events;

		if (!$events)
		{
			$events = new EventCollection($app->configs['event']);

			EventCollectionProvider::define(function () use ($app) {

				return $app->events;

			});
		}

		return $events;
	}
}
