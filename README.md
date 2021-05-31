# bind-event

[![Release](https://img.shields.io/packagist/v/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)
[![Build Status](https://img.shields.io/travis/ICanBoogie/bind-event/master.svg)](http://travis-ci.org/ICanBoogie/bind-event)
[![Code Quality](https://img.shields.io/scrutinizer/g/ICanBoogie/bind-event/master.svg)](https://scrutinizer-ci.com/g/ICanBoogie/bind-event)
[![Code Coverage](https://img.shields.io/coveralls/ICanBoogie/bind-event/master.svg)](https://coveralls.io/r/ICanBoogie/bind-event)
[![Packagist](https://img.shields.io/packagist/dt/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)

The **icanboogie/bind-event** package binds [icanboogie/event][] to [ICanBoogie][], using its
[Autoconfig feature][]. It provides a config synthesizer for event hooks defined in `event`
configuration fragments, and an `events` getter for [Application][] instances.

```php
<?php

namespace ICanBoogie;

require 'vendor/autoload.php';

$app = boot();

$app->configs['event']; // obtain the "event" config.
$app->events;           // obtain an EventCollection instance created with the "event" config.
```





## Attaching event hooks using the `event` config

The `event` config can be used to define event hooks.

The following example demonstrates how an application can attach event hooks to be notified when
nodes are saved (or nodes subclasses), and when an authentication exception is thrown during the
dispatch of a request.

```php
<?php

// config/event.php

namespace App;

use ICanBoogie;
use Icybee;

$hooks = Hooks::class . '::';

return [

	Icybee\Modules\Nodes\SaveOperation::class . '::process' => $hooks . 'on_nodes_save',
	ICanBoogie\HTTP\AuthenticationRequired::class . '::rescue' => $hooks . 'on_authentication_required_rescue'

];
```





----------





## Requirements

The package requires PHP 7.2 or later.





## Installation

```bash
composer require icanboogie/bind-event
```





## Documentation

The package is documented as part of the [ICanBoogie][] framework [documentation][]. You can
generate the documentation for the package and its dependencies with the `make doc` command. The
documentation is generated in the `build/docs` directory. [ApiGen](http://apigen.org/) is required.
The directory can later be cleaned with the `make clean` command.





## Testing

Run `make test-container` to create and log into the test container, then run `make test` to run the
test suite. Alternatively, run `make test-coverage` to run the test suite with test coverage. Open
`build/coverage/index.html` to see the breakdown of the code coverage.





## License

**icanboogie/bind-event** is released under the [New BSD License](LICENSE).





[documentation]:         https://icanboogie.org/api/bind-event/3.0/
[ICanBoogie]:            https://icanboogie.org/
[Application]:           https://icanboogie.org/api/icanboogie/4.0/class-ICanBoogie.Core.html
[Autoconfig feature]:    https://icanboogie.org/docs/4.0/autoconfig
[icanboogie/event]:      https://github.com/ICanBoogie/Event
