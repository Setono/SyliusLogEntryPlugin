# Sylius Log Entry Plugin

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Quality Score][ico-code-quality]][link-code-quality]

Adds a `LogEntry` entity you can use to log messages and associate them with your other entities.
The test application has an example where we have added log entries to orders.

## Installation

* Install plugin using `composer`:

    ```bash
    $ composer require setono/sylius-log-entry-plugin
    ```

* Add bundle to `config/bundles.php`:

    ```php
    <?php
    // config/bundles.php
    
    return [
        // ...
        Setono\SyliusLogEntryPlugin\SetonoSyliusLogEntryPlugin::class => ['all' => true],
    ];
    ```

* Configure entities & repositories like here:
  
    * [Entities](tests/Application/Entity)
    * [Overriding](tests/Application/config/packages/setono_sylius_log_entry.yaml)

* Import routes:

    ```yaml
    # config/routes/setono_sylius_log_entry.yaml
    setono_sylius_log_entry:
        resource: "@SetonoSyliusLogEntryPlugin/Resources/config/routes.yaml"
    ```

* Update your schema:

    ```bash
    # Generate and edit migration
    bin/console doctrine:migrations:diff

    # Then apply migration
    bin/console doctrine:migrations:migrate
    ```

# Contribution

## Installation

To automatically execute installation steps, load fixtures 
and run server with just one command, run:

```bash
# Optional step, if 5 mins enough for webserver to try
# @see https://getcomposer.org/doc/06-config.md#process-timeout
composer config --global process-timeout 0

composer try
```

## Running plugin tests

  - PHPSpec

    ```bash
    $ composer phpspec
    ```

  - Behat

    ```bash
    $ composer behat
    ```

  - All tests (phpspec & behat)

    ```bash
    $ composer test
    ```
    
## Pushing changes & making PRs

Please run `composer all` to run all checks and tests before making PR or pushing changes to repo.

[ico-version]: https://poser.pugx.org/setono/sylius-log-entry-plugin/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/sylius-log-entry-plugin/v/unstable
[ico-license]: https://poser.pugx.org/setono/sylius-log-entry-plugin/license
[ico-github-actions]: https://github.com/Setono/SyliusLogEntryPlugin/workflows/Build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/SyliusLogEntryPlugin.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/setono/sylius-log-entry-plugin
[link-github-actions]: https://github.com/Setono/SyliusLogEntryPlugin/actions
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/SyliusLogEntryPlugin
