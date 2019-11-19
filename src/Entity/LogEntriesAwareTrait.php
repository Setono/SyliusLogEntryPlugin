<?php

declare(strict_types=1);

namespace Setono\LogEntryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait LogEntriesAwareTrait
{
    /**
     * @var Collection|LogEntryInterface[]
     */
    protected $logEntries;

    public function __construct()
    {
        $this->logEntries = new ArrayCollection();
    }

    public function getLogEntries(): Collection
    {
        return $this->logEntries;
    }

    public function hasLogEntries(): bool
    {
        return !$this->logEntries->isEmpty();
    }

    public function addLogEntry(LogEntryInterface $logEntry): void
    {
        if ($this->hasLogEntry($logEntry)) {
            return;
        }

        $this->logEntries->add($logEntry);
    }

    public function removeLogEntry(LogEntryInterface $logEntry): void
    {
        if (!$this->hasLogEntry($logEntry)) {
            return;
        }

        $this->logEntries->removeElement($logEntry);
    }

    public function hasLogEntry(LogEntryInterface $logEntry): bool
    {
        return $this->logEntries->contains($logEntry);
    }
}
