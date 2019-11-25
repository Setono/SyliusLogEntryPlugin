<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Factory;

use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareInterface;
use Setono\SyliusLogEntryPlugin\Model\LogEntryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class LogEntryFactory implements FactoryInterface
{
    private $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    /**
     * @return LogEntryInterface
     */
    public function createNew()
    {
        return new $this->className();
    }

    /**
     * @param LogEntriesAwareInterface $owner
     *
     * @return LogEntryInterface
     */
    public function createNewForOwner(LogEntriesAwareInterface $owner)
    {
        $resource = $this->createNew();
        $resource->setOwner($owner);
        return $resource;
    }
}
