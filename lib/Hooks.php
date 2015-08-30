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

use ICanBoogie\Core;
use ICanBoogie\EventCollection;
use ICanBoogie\EventCollectionProvider;

class Hooks
{
	/**
	 * Synthesizes a configuration suitable to create {@link EventCollection} instances, from
	 * "event" config fragments.
	 *
	 * @param array $fragments Configuration fragments.
	 *
	 * @throws \InvalidArgumentException in attempt to specify an invalid event callback.
	 *
	 * @return array
	 */
	static public function synthesize_config(array $fragments)
	{
		$events = [];

		foreach ($fragments as $pathname => $fragment)
		{
			foreach ($fragment as $type => $callback)
			{
				#
				# because modules are ordered by weight (most important are first), we can
				# push callbacks instead of unshifting them.
				#

				$events[$type][] = $callback;
			}
		}

		return $events;
	}

	/**
	 * Returns an {@link EventCollection} instance created with the hooks from the `events` config.
	 *
	 * @param Core $app
	 *
	 * @return EventCollection
	 */
	static public function get_events(Core $app)
	{
		static $events;

		if (!$events)
		{
			$events = new EventCollection($app->configs['event']);

			EventCollectionProvider::using(function () use ($app) {

				return $app->events;

			});
		}

		return $events;
	}
}
