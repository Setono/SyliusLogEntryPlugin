# Symfony Log Entry Bundle

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]

Adds a `LogEntry` entity you can use to log messages and associate them with your other entities.

## Installation

### Step 1: Download the bundle

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```bash
$ composer require setono/log-entry-bundle
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.


### Step 2: Enable the bundle

Enable the bundle by adding it to the list of registered bundles in `config/bundles.php`:

```php
<?php
$bundles = [
    // ...
    
    Setono\LogEntryBundle\SetonoLogEntryBundle::class => ['all' => true],
    
    // ...
];
```

## Usage

TODO

[ico-version]: https://poser.pugx.org/setono/log-entry-bundle/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/log-entry-bundle/v/unstable
[ico-license]: https://poser.pugx.org/setono/log-entry-bundle/license
[ico-travis]: https://travis-ci.com/Setono/LogEntryBundle.svg?branch=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/LogEntryBundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/setono/log-entry-bundle
[link-travis]: https://travis-ci.com/Setono/LogEntryBundle
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/LogEntryBundle
