<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLogEntryPlugin;

use PHPUnit\Framework\TestCase;
use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareInterface;
use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareTrait;
use Setono\SyliusLogEntryPlugin\Model\LogEntry;
use Setono\SyliusLogEntryPlugin\Model\LogEntryInterface;

final class LogEntriesAwareTraitTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_log_entries(): void
    {
        $obj = self::getObject();

        $logEntry = self::getLogEntry();

        $obj->addLogEntry($logEntry);

        $this->assertCount(1, $obj->getLogEntries());
        $this->assertSame($logEntry, $obj->getLogEntries()->first());
    }

    /**
     * @test
     */
    public function it_does_not_add_more_of_the_same(): void
    {
        $obj = self::getObject();

        $logEntry = self::getLogEntry();

        $obj->addLogEntry($logEntry);
        $obj->addLogEntry($logEntry);

        $this->assertCount(1, $obj->getLogEntries());
    }

    /**
     * @test
     */
    public function it_removes_log_entry(): void
    {
        $obj = self::getObject();

        $logEntry1 = self::getLogEntry();
        $logEntry2 = self::getLogEntry();

        $obj->addLogEntry($logEntry1);
        $obj->addLogEntry($logEntry2);

        $obj->removeLogEntry($logEntry1);

        $this->assertCount(1, $obj->getLogEntries());
        $this->assertSame($logEntry2, $obj->getLogEntries()->first());
    }

    private static function getObject(): LogEntriesAwareInterface
    {
        return new class() implements LogEntriesAwareInterface {
            use LogEntriesAwareTrait;
        };
    }

    private static function getLogEntry(): LogEntryInterface
    {
        return new class extends LogEntry {};
    }
}
