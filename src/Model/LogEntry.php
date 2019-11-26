<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Model;

use DateTimeInterface;
use Psr\Log\LogLevel;
use Webmozart\Assert\Assert;

abstract class LogEntry implements LogEntryInterface
{
    /** @var mixed */
    protected $id;

    /** @var LogEntriesAwareInterface|null */
    protected $owner;

    /** @var string */
    protected $level;

    /** @var string */
    protected $message;

    /** @var array|null */
    protected $context;

    /** @var DateTimeInterface */
    protected $createdAt;

    /** @var DateTimeInterface|null */
    protected $updatedAt;

    public function __construct()
    {
        $this->setLevel(LogLevel::INFO);
    }

    public function getOwner(): ?LogEntriesAwareInterface
    {
        return $this->owner;
    }

    public function setOwner(?LogEntriesAwareInterface $owner): void
    {
        if ($this->owner === $owner) {
            return;
        }

        $this->owner = $owner;

        if (null !== $owner) {
            $owner->addLogEntry($this);
        }
    }

    public static function getLevels(): array
    {
        return [
            LogLevel::EMERGENCY => LogLevel::EMERGENCY,
            LogLevel::ALERT => LogLevel::ALERT,
            LogLevel::CRITICAL => LogLevel::CRITICAL,
            LogLevel::ERROR => LogLevel::ERROR,
            LogLevel::WARNING => LogLevel::WARNING,
            LogLevel::NOTICE => LogLevel::NOTICE,
            LogLevel::INFO => LogLevel::INFO,
            LogLevel::DEBUG => LogLevel::DEBUG,
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): void
    {
        Assert::oneOf(
            $level,
            self::getLevels(),
            'Wrong log entry level. Expected one of: %2$s. Got: %s'
        );

        $this->level = $level;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getContext(): ?array
    {
        return $this->context;
    }

    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
