<?php

declare(strict_types=1);

namespace Setono\LogEntryBundle\Entity;

use DateTimeInterface;

interface LogEntryInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * Returns an array of available log levels.
     */
    public static function getLevels(): array;

    /**
     * Must return a default level.
     */
    public function getLevel(): string;

    public function setLevel(string $level): void;

    public function getMessage(): ?string;

    public function setMessage(string $message): void;

    public function getContext(): ?array;

    /**
     * Use this to set arbitrary data related to the log entry.
     */
    public function setContext(array $context): void;

    public function getCreatedAt(): ?DateTimeInterface;

    public function setCreatedAt(DateTimeInterface $createdAt): void;

    public function getUpdatedAt(): ?DateTimeInterface;

    public function setUpdatedAt(DateTimeInterface $updatedAt): void;
}
