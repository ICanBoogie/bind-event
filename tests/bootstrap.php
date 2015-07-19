<?php

/*
 * This file is part of the ICanBoogie package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ICanBoogie;

use ICanBoogie\Binding\Event\CoreBindings as EventBindings;

require __DIR__ . '/../vendor/autoload.php';

class Application extends Core
{
	use EventBindings;
}

(new Application(array_merge_recursive(get_autoconfig(), [

	'config-path' => [

		__DIR__ . '/config' => 0

	]

])))->boot();
