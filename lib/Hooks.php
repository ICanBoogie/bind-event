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

final class Hooks
{
	/**
	 * Returns an {@link EventCollection} instance created with the hooks from the `events` config.
	 *
	 * @uses EventConfigSynthesizer::synthesize()
	 */
	static public function get_events(Application $app): EventCollection
	{
		static $events;

		if (!$events)
		{
			$events = new EventCollection($app->configs['event']);

			EventCollectionProvider::define(function () use ($app): EventCollection {

				return $app->events;

			});
		}

		return $events;
	}
}
