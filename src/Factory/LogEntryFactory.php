<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Factory;

use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareInterface;
use Setono\SyliusLogEntryPlugin\Model\LogEntryInterface;

final class LogEntryFactory implements LogEntryFactoryInterface
{
    /** @var string */
    private $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function createNew(): LogEntryInterface
    {
        return new $this->className();
    }

    public function createNewForOwner(LogEntriesAwareInterface $owner): LogEntryInterface
    {
        $resource = $this->createNew();
        $resource->setOwner($owner);

        return $resource;
    }
}
