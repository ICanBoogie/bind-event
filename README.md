# bind-event

[![Release](https://img.shields.io/packagist/v/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)
[![Code Coverage](https://coveralls.io/repos/github/ICanBoogie/bind-event/badge.svg?branch=6.0)](https://coveralls.io/r/ICanBoogie/bind-event?branch=6.0)
[![Downloads](https://img.shields.io/packagist/dt/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)

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



#### Installation

```shell
composer require icanboogie/bind-event
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



## Continuous Integration

The project is continuously tested by [GitHub actions](https://github.com/ICanBoogie/bind-event/actions).

[![Tests](https://github.com/ICanBoogie/bind-event/actions/workflows/test.yml/badge.svg?branch=6.0)](https://github.com/ICanBoogie/bind-event/actions/workflows/test.yml)
[![Static Analysis](https://github.com/ICanBoogie/bind-event/actions/workflows/static-analysis.yml/badge.svg?branch=6.0)](https://github.com/ICanBoogie/bind-event/actions/workflows/static-analysis.yml)
[![Code Style](https://github.com/ICanBoogie/bind-event/actions/workflows/code-style.yml/badge.svg?branch=6.0)](https://github.com/ICanBoogie/bind-event/actions/workflows/code-style.yml)



## Code of Conduct

This project adheres to a [Contributor Code of Conduct](CODE_OF_CONDUCT.md). By participating in
this project and its community, you're expected to uphold this code.



## Contributing

See [CONTRIBUTING](CONTRIBUTING.md) for details.



[ICanBoogie]:            https://icanboogie.org/
[Application]:           https://icanboogie.org/api/icanboogie/4.0/class-ICanBoogie.Core.html
[Autoconfig feature]:    https://icanboogie.org/docs/4.0/autoconfig
[icanboogie/event]:      https://github.com/ICanBoogie/Event
