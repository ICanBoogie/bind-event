# bind-event

[![Release](https://img.shields.io/packagist/v/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)
[![Code Coverage](https://coveralls.io/repos/github/ICanBoogie/bind-event/badge.svg?branch=7.0)](https://coveralls.io/r/ICanBoogie/bind-event?branch=7.0)
[![Downloads](https://img.shields.io/packagist/dt/icanboogie/bind-event.svg)](https://packagist.org/packages/icanboogie/bind-event)

The **icanboogie/bind-event** package binds [icanboogie/event][] to [ICanBoogie][], using its
[Autoconfig feature][]. It provides a config builder for event listeners defined in `event`
configuration fragments, registers `EventCollection` as a service (public, autowirable), and adds an `event:list`
console command.

```php
<?php

namespace ICanBoogie;

require 'vendor/autoload.php';

$app = boot();

$app->config_for_class(Event\Config::class); // obtain the event config.
```



#### Installation

```shell
composer require icanboogie/bind-event
```



## Attaching event listeners using the `event` config

Event listeners are defined in `event` configuration fragments (e.g. `config/event.php`). A fragment
returns a closure that receives a `ConfigBuilder` instance.

The following example attaches a listener to an event, and a listener to an event for a specific sender.

```php
<?php

// config/event.php

namespace App;

use ICanBoogie\Event\ConfigBuilder;

return fn(ConfigBuilder $config) => $config
    ->attach(NodeSavedEvent::class, [ Hooks::class, 'on_node_saved' ])
    ->attach_to(Request::class, RescueEvent::class, [ Hooks::class, 'on_rescue' ]);
```

- `attach($event_class, $listener)` attaches a listener to an event, **whatever its sender**.
- `attach_to($sender_class, $event_class, $listener)` attaches a listener to an event emitted **with a
  sender** of that class, a subclass, or an implementation of that interface.
- `enable_discovery()` discovers listeners annotated with the `ICanBoogie\Event\Listener` attribute.

```php
return fn(ConfigBuilder $config) => $config->enable_discovery();
```

> [!IMPORTANT]
> The fragment is named `event`. It is looked up as `event.php` in every config path registered through
> [Autoconfig][] (`config-path` in `composer.json`), e.g. `app/all/config/event.php` in an application.
> The project needs no other setup: if the file doesn't exist, no listener is attached.

> [!NOTE]
> `attach()` catches the event whatever its sender. Use `attach_to()` to only catch the events of a given
> sender. See [Events with a sender](#events-with-a-sender).



## Events with a sender

The matching rules belong to [icanboogie/event][], read [Events with a sender][event-sender] there. In short:

- An event emitted with a sender has the qualified type `Sender::Event`. `attach()` registers the bare
  `Event`, which matches every `Event`, whatever the sender. `attach_to()` narrows it down to a sender.
- Listeners are matched against the sender's class, its parent classes, then the interfaces it implements.
  `attach_to()` requires a loadable class or interface.

For instance, to log both exceptions and errors, attach the listener to `Throwable`:

```php
<?php

// config/event.php

namespace App;

use ICanBoogie\Event\ConfigBuilder;
use ICanBoogie\HTTP\RecoverEvent;

use function ICanBoogie\Service\ref;

return fn(ConfigBuilder $config) => $config
    ->attach_to(\Throwable::class, RecoverEvent::class, ref(ExceptionLogger::class));
```



## Attaching listeners using the `#[Listener]` attribute

Call `enable_discovery()` and mark methods with the `ICanBoogie\Event\Listener` attribute. The attribute is
provided by [icanboogie/event][] (`event/lib/Event/Listener.php`), and found using
[olvlvl/composer-attribute-collector][], which must be set up in your project.

```php
<?php

namespace App;

use ICanBoogie\Event\Listener;
use ICanBoogie\HTTP\RecoverEvent;

final class LogException
{
    #[Listener]
    public function __invoke(RecoverEvent $event, \Throwable $sender): void
    {
        // …
    }
}
```

- One parameter attaches to the bare event type, as `attach()` does. Two parameters attach to the qualified
  type, as `attach_to()` does: the second parameter is the sender class.
- Static methods are attached as `[class, method]`. Non-static methods must be `__invoke()`, and the class is
  resolved as a service (or `#[Listener(ref: 'service_id')]`).
- There is one attribute per method, and a method names a single sender type (class or interface, e.g.
  `Throwable`). To listen to several unrelated senders, use `attach_to()` once per type.



## Listeners that are services

Use `ICanBoogie\Service\ref()` to attach a listener that is a service. It is resolved when the event is
emitted, **not** when the config is built: the service must be **public**, otherwise the failure only
occurs when the first event is emitted.

```yaml
# config/services.yml

services:
  App\ExceptionLogger:
    public: true
```

Classes using `#[Listener]` on `__invoke()` are services too, and must be public for the same reason.



## Listing event listeners

The `event:list` command (alias `events`) lists the listeners found in the `event` config, with the event
type they're attached to.

```shell
php vendor/bin/icanboogie events
```

The _Event_ column shows the **qualified** type. A listener of an event with a sender shows as
`RuntimeException::ICanBoogie\HTTP\RecoverEvent`. If it shows as the bare `ICanBoogie\HTTP\RecoverEvent`,
it's called whatever the sender. The command lists the config only, listeners
attached at runtime with `$app->events->attach()` are not shown.

Being listed doesn't mean being called, see below.



## Troubleshooting: my listener is not called

A unit test of the listener proves nothing about its registration. Run `events` and compare the listed type
with `$event->qualified_type` of the emitted event: for an event with a sender, the listener must be attached to
the sender's class, a parent class, or an interface it implements. `$app->events->get_hooks($event->qualified_type)`
shows what actually matches, and `EventProfiler::iter_unused()` lists the types emitted with no hook. For a
service listener, also check that the service is public.



----------



## Continuous Integration

The project is continuously tested by [GitHub actions](https://github.com/ICanBoogie/bind-event/actions).

[![Tests](https://github.com/ICanBoogie/bind-event/actions/workflows/test.yml/badge.svg?branch=7.0)](https://github.com/ICanBoogie/bind-event/actions/workflows/test.yml)
[![Static Analysis](https://github.com/ICanBoogie/bind-event/actions/workflows/static-analysis.yml/badge.svg?branch=7.0)](https://github.com/ICanBoogie/bind-event/actions/workflows/static-analysis.yml)
[![Code Style](https://github.com/ICanBoogie/bind-event/actions/workflows/code-style.yml/badge.svg?branch=7.0)](https://github.com/ICanBoogie/bind-event/actions/workflows/code-style.yml)



## Code of Conduct

This project adheres to a [Contributor Code of Conduct](CODE_OF_CONDUCT.md). By participating in
this project and its community, you're expected to uphold this code.



## Contributing

See [CONTRIBUTING](CONTRIBUTING.md) for details.



[ICanBoogie]:            https://icanboogie.org/
[Application]:           https://icanboogie.org/api/icanboogie/4.0/class-ICanBoogie.Core.html
[Autoconfig feature]:    https://icanboogie.org/docs/4.0/autoconfig
[icanboogie/event]:      https://github.com/ICanBoogie/Event
[event-sender]:          https://github.com/ICanBoogie/Event#events-with-a-sender
[olvlvl/composer-attribute-collector]: https://github.com/olvlvl/composer-attribute-collector
