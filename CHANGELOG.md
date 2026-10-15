# CHANGELOG

## v7.0.0

### New Requirements

- PHP 8.4+

### New features

None

### Deprecated Features

None

### Backward Incompatible Changes

- Removed `ICanBoogie\Binding\Event\ConfigBuilder`; `event` fragments now receive `ICanBoogie\Event\ConfigBuilder`, which
  implements `ICanBoogie\Config\Builder`.

### Other Changes

- Updated the README: config fragment location, `attach()` vs `attach_to()` and events with a sender, `#[Listener]`, listeners that are services, how to read `event:list`, and troubleshooting.



## v6.0.0

### New Requirements

- PHP 8.2+

### New features

None

### Deprecated Features

None

### Backward Incompatible Changes

None

### Other Changes

None
