<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Setono\SyliusLogEntryPlugin\Model\LogEntry;

final class SetonoSyliusLogEntryExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [
            new SetonoSyliusLogEntryExtension(),
        ];
    }

    /**
     * @test
     */
    public function after_loading_the_correct_parameter_has_been_set(): void
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('setono_sylius_log_entry.entity.log_entry.class', LogEntry::class);
    }
}
