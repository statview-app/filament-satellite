# Installation
>You should have already installed and configured `statview/satellite` in your project before using this package. 
```bash
composer require statview/filament-satellite
```

### Usage
>It's important to have one default Filament Panel. You can do so by adding `->default()` to one of your panels.

The package contains a Filament plugin. It's easy to add the configuration to you panel.

```php
<?php
use Statview\FilamentSatellite\SatellitePlugin;
// ...
->plugins([
    SatellitePlugin::make(),
])
// ...
```
## Features
### One click login
You can enable one click login by adding this to the plugin's config.
```php
use Statview\FilamentSatellite\SatellitePlugin;

SatellitePlugin::make()
    ->oneClickLogin(
        user: fn () => User::first(),
        redirect: fn () => DashboardPage::getUrl(),
    ),
```

### Announcements
Announcements are enabled by default. You can disable them easily by adding this to the plugin's config.
```php
use Statview\FilamentSatellite\SatellitePlugin;

SatellitePlugin::make()
    ->announcements(flag: false);
```
