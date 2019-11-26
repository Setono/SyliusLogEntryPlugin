<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLogEntryPlugin;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Setono\SyliusLogEntryPlugin\DependencyInjection\Configuration;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }

    /**
     * @test
     */
    public function processed_value_contains_required_value(): void
    {
        $this->assertProcessedConfigurationEquals([], [
            'driver' => SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
        ]);
    }
}
