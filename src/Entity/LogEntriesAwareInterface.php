<?php

declare(strict_types=1);

namespace Setono\LogEntryBundle\Entity;

use Doctrine\Common\Collections\Collection;

interface LogEntriesAwareInterface
{
    /**
     * @return Collection|LogEntryInterface[]
     */
    public function getLogEntries(): Collection;

    public function hasLogEntries(): bool;

    public function addLogEntry(LogEntryInterface $logEntry): void;

    public function removeLogEntry(LogEntryInterface $logEntry): void;

    public function hasLogEntry(LogEntryInterface $logEntry): bool;
}
