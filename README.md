# bind-event

[![Release](https://img.shields.io/packagist/v/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)
[![Build Status](https://img.shields.io/travis/ICanBoogie/bind-event/master.svg)](http://travis-ci.org/ICanBoogie/bind-event)
[![HHVM](https://img.shields.io/hhvm/icanboogie/bind-event.svg)](http://hhvm.h4cc.de/package/icanboogie/bind-event)
[![Code Quality](https://img.shields.io/scrutinizer/g/ICanBoogie/bind-event/master.svg)](https://scrutinizer-ci.com/g/ICanBoogie/bind-event)
[![Code Coverage](https://img.shields.io/coveralls/ICanBoogie/bind-event/master.svg)](https://coveralls.io/r/ICanBoogie/bind-event)
[![Packagist](https://img.shields.io/packagist/dt/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)

The **icanboogie/bind-event** package binds [icanboogie/event][] to [ICanBoogie][], using its
[Autoconfig feature][]. It provides a config synthesizer for event hooks defined in `event`
configuration fragments, and an `events` getter for [Core][] instances.

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

The package requires PHP 5.5 or later.





## Installation

The recommended way to install this package is through [Composer](http://getcomposer.org/):

```
$ composer require icanboogie/bind-event
```

The package only specifies a minimum version while requiring [icanboogie/icanboogie][] and
[icanboogie/event], you might want to specify which version to use in your "composer.json" file.





### Cloning the repository

The package is [available on GitHub](https://github.com/ICanBoogie/bind-event), its repository
can be cloned with the following command line:

	$ git clone https://github.com/ICanBoogie/bind-event.git





## Documentation

The package is documented as part of the [ICanBoogie][] framework
[documentation](http://icanboogie.org/docs/). You can generate the documentation for the package
and its dependencies with the `make doc` command. The documentation is generated in the
`build/docs` directory. [ApiGen](http://apigen.org/) is required. The directory can later be
cleaned with the `make clean` command.





## Testing

The test suite is ran with the `make test` command. [PHPUnit](https://phpunit.de/) and
[Composer](http://getcomposer.org/) need to be globally available to run the suite. The command
installs dependencies as required. The `make test-coverage` command runs test suite and also
creates an HTML coverage report in "build/coverage". The directory can later be cleaned with
the `make clean` command.

The package is continuously tested by [Travis CI](http://about.travis-ci.org/).

[![Build Status](https://img.shields.io/travis/ICanBoogie/bind-event/master.svg)](https://travis-ci.org/ICanBoogie/bind-event)
[![Code Coverage](https://img.shields.io/coveralls/ICanBoogie/bind-event/master.svg)](https://coveralls.io/r/ICanBoogie/bind-event)





## License

**icanboogie/bind-event** is licensed under the New BSD License - See the [LICENSE](LICENSE) file for details.





[icanboogie/icanboogie]: https://github.com/ICanBoogie/ICanBoogie
[icanboogie/event]: https://github.com/ICanBoogie/Event
[Autoconfig feature]: https://github.com/ICanBoogie/ICanBoogie#autoconfig
[ICanBoogie]: https://github.com/ICanBoogie/ICanBoogie
[Core]: http://api.icanboogie.org/icanboogie/2.4/class-ICanBoogie.Core.html
