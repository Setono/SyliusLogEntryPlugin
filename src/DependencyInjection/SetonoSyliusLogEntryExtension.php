<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\DependencyInjection;

use Exception;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SetonoSyliusLogEntryExtension extends AbstractResourceExtension
{
    /**
     * @throws Exception
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        // Notice that we give an empty resources array here, but this ensures that the parameters are set in the AbstractResourceExtension
        // which in turn will run the compiler pass Symfony\Bridge\Doctrine\DependencyInjection\CompilerPass\RegisterMappingsPass
        $this->registerResources('setono_sylius_returns', $config['driver'], [], $container);
    }
}
