# Configurable Bootstrap for Laravel 5

This is **Laravel 5** package for including bootstrap package to application. Is highly configurable via config file.

## Table of content

* [Features](#features)
* [Installation](#installation)
* [Configuration](#configuration)
* [Usage](#usage)

---
[Back to top](#configurable-bootstrap-for-laravel-5)

## Features

* Configurable
* Minfied css and js files

---
[Back to top](#configurable-bootstrap-for-laravel-5)

## Installation

Via `composer`:

```bash
composer require vi-kon/laravel-bootstrap
```
In your Laravel 5 project add following lines to `app.php`:
```php
// to your providers array
'ViKon\Bootstrap\BootstrapServiceProvider',
```

## Configuration

Publish package config file:

```bash
php artisan vendor:publish --provider="ViKon\Bootstrap\BootstrapServiceProvider" --tag="config"
```

After config publish `bootstrap.php` file appears under `config` directory with following options:

```php
/*
| --------------------------------------------------------------------------
| Output minifiing
| --------------------------------------------------------------------------
| If false generated javascript and css files are minified
|
*/
'minify'     => false,

/*
| --------------------------------------------------------------------------
| Forcing generation
| --------------------------------------------------------------------------
| Force package to regenerate files
|
*/
'force'      => false,

/*
| --------------------------------------------------------------------------
| Components
| --------------------------------------------------------------------------
| Options for enabling or disabling bootstrap modules
|
*/
'components' => [
    // Reset and dependencies
    'normalize'            => false,
    'print'                => false,
    'glyphicons'           => false,

    // Core CSS
    'scaffolding'          => false,
    'type'                 => false,
    'code'                 => false,
    'grid'                 => false,
    'tables'               => false,
    'forms'                => false,
    'buttons'              => false,

    // Components
    'component-animations' => false,
    'dropdowns'            => false,
    'button-groups'        => false,
    'input-groups'         => false,
    'navs'                 => false,
    'navbar'               => false,
    'breadcrumbs'          => false,
    'pagination'           => false,
    'pager'                => false,
    'labels'               => false,
    'badges'               => false,
    'jumbotron'            => false,
    'thumbnails'           => false,
    'alerts'               => false,
    'progress-bars'        => false,
    'media'                => false,
    'list-group'           => false,
    'panels'               => false,
    'responsive-embed'     => false,
    'wells'                => false,
    'close'                => false,

    // Components w/ JavaScript
    'modals'               => false,
    'tooltip'              => false,
    'popovers'             => false,
    'carousel'             => false,

    // Pure JavaScript components
    'affix'                => false,
    'alert'                => false,
    'button'               => false,
    'collapse'             => false,
    'scrollspy'            => false,
    'tab'                  => false,
    'transition'           => false,

    // Utility classes
    'utilities'            => false,
    'responsive-utilities' => false,
],
```

---
[Back to top](#configurable-bootstrap-for-laravel-5)

## Usage



---
[Back to top](#configurable-bootstrap-for-laravel-5)

## License

This package is licensed under the MIT License

---
[Back to top](#configurable-bootstrap-for-laravel-5)
