# Symfony Log Entry Bundle

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
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

### Step 3: Create entity

Create your entity like this:

```php
<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Setono\LogEntryBundle\Entity\LogEntry as BaseLogEntry;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_log_entry")
 */
class LogEntry extends BaseLogEntry
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
```

## Usage example

Here is an `Order` entity where we want to let the administrator create log messages on the order:

```php
<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Setono\LogEntryBundle\Entity\LogEntriesAwareInterface as SetonoLogEntryLogEntriesAwareInterface;
use Setono\LogEntryBundle\Entity\LogEntriesAwareTrait as SetonoLogEntryLogEntriesAwareTrait;
use Setono\LogEntryBundle\Entity\LogEntryInterface;

/**
 * @ORM\Table(name="app_order")
 * @ORM\Entity()
 */
class Order implements SetonoLogEntryLogEntriesAwareInterface
{
    use SetonoLogEntryLogEntriesAwareTrait {
        SetonoLogEntryLogEntriesAwareTrait::__construct as private __setonoLogEntryBundleLogEntriesAwareTraitConstruct;
    }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\LogEntry")
     * @ORM\JoinTable(name="app_order_log_entries",
     *   joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="log_entry_id", referencedColumnName="id", unique=true)}
     * )
     *
     * @var Collection|LogEntryInterface[]
     */
    protected $logEntries;

    public function __construct()
    {
        $this->__setonoLogEntryBundleLogEntriesAwareTraitConstruct();
    }
}

```

[ico-version]: https://poser.pugx.org/setono/log-entry-bundle/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/log-entry-bundle/v/unstable
[ico-license]: https://poser.pugx.org/setono/log-entry-bundle/license
[ico-github-actions]: https://github.com/Setono/LogEntryBundle/workflows/Build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/LogEntryBundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/setono/log-entry-bundle
[link-github-actions]: https://github.com/Setono/LogEntryBundle/actions
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/LogEntryBundle
