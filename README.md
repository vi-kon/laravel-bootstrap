# Configurable Bootstrap framework for Laravel 5.1

This is **Laravel 5.1** package for compiling Bootstrap framework to application.

## Table of content

* [Features](#features)
* [Installation](#installation)
* [Usage](#usage)
* [Components](#components)

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
ViKon\Bootstrap\BootstrapServiceProvider::class,
```

```php
// to your aliases array
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,
```

---
[Back to top](#configurable-bootstrap-for-laravel-5)

## Usage

Simply run `vi-kon:bootstrap:compile {component-name} {component-name}` command to generate bootstrap files (booth CSS
and JS).

The `vi-kob:bootstrap:compile` command have several options:

- `--all`    - Select all components
- `--except` - Exclude selected component. Only available if `--all` option set.
- `--force`  - Overwrite existing files

---
[Back to top](#configurable-bootstrap-for-laravel-5)

## Components

Available components (This tokens can use in command):

- **Reset and dependencies**
  - normalize
  - print
  - glyphicons
- **Core CSS**
  - scaffolding
  - type
  - code
  - grid
  - tables
  - forms
  - buttons
- **Components**
  - component-animations
  - dropdowns
  - button-groups
  - input-groups
  - navs
  - navbar
  - breadcrumbs
  - pagination
  - pager
  - labels
  - badges
  - jumbotron
  - thumbnails
  - alerts
  - progress-bars
  - media
  - list-group
  - panels
  - responsive-embed
  - wells
  - close
- **Components with JavaScript**
  - modals
  - tooltip
  - popovers
  - carousel
- **Pure JavaScript components**
  - affix
  - alert
  - button
  - collapse
  - scrollspy
  - tab
  - transition
- **Utility classes**
  - utilities
  - responsive-utilities

More about components http://getbootstrap.com/.

## License

This package is licensed under the MIT License

---
[Back to top](#configurable-bootstrap-for-laravel-5)
