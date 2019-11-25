<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLogEntryPlugin;

use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;
use Setono\SyliusLogEntryPlugin\Model\LogEntry;

final class LogEntryTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_default_level(): void
    {
        $logEntry = new LogEntry();
        $this->assertSame(LogLevel::INFO, $logEntry->getLevel());
    }

    /**
     * @test
     */
    public function it_sets_values(): void
    {
        $now = new DateTime();
        $context = ['context' => 'please'];

        $logEntry = new LogEntry();
        $logEntry->setLevel(LogLevel::DEBUG);
        $logEntry->setMessage('Test');
        $logEntry->setContext($context);
        $logEntry->setCreatedAt($now);
        $logEntry->setUpdatedAt($now);

        $this->assertSame(LogLevel::DEBUG, $logEntry->getLevel());
        $this->assertSame('Test', $logEntry->getMessage());
        $this->assertSame($context, $logEntry->getContext());
        $this->assertSame($now, $logEntry->getCreatedAt());
        $this->assertSame($now, $logEntry->getUpdatedAt());
    }

    /**
     * @test
     */
    public function it_throws_exception_when_given_wrong_level(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $logEntry = new LogEntry();
        $logEntry->setLevel('wrong');
    }
}
