<?php

declare(strict_types=1);

namespace Setono\LogEntryBundle\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Setono\LogEntryBundle\Entity\LogEntry;

final class SetonoLogEntryExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [
            new SetonoLogEntryExtension(),
        ];
    }

    /**
     * @test
     */
    public function after_loading_the_correct_parameter_has_been_set(): void
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('setono_log_entry.entity.log_entry.class', LogEntry::class);
    }
}
