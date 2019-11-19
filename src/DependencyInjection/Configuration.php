<?php

declare(strict_types=1);

namespace Setono\LogEntryBundle\DependencyInjection;

use Setono\LogEntryBundle\Entity\LogEntry;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if (method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder('setono_log_entry');
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('setono_log_entry');
        }

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('log_entry_class')
                    ->defaultValue(LogEntry::class)
                    ->example('App\Entity\LogEntry')
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
