<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Factory;

use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareInterface;
use Setono\SyliusLogEntryPlugin\Model\LogEntryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface LogEntryFactoryInterface extends FactoryInterface
{
    public function createNew(): LogEntryInterface;

    public function createNewForOwner(LogEntriesAwareInterface $owner): LogEntryInterface;
}
