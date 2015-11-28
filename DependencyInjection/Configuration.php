<?php

namespace Minishlink\Bundle\WebPushBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('minishlink_web_push');

        $rootNode
            ->children()
                ->scalarNode('api_keys')
                    ->defaultValue(array())
                    ->end()
                ->scalarNode('ttl')
                    ->defaultValue(null)
                    ->end()
                ->scalarNode('timeout')
                    ->defaultValue(10)
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
