<?php

namespace Minishlink\Bundle\WebPushBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('minishlink_web_push');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('VAPID')
                    ->children()
                        ->scalarNode('subject')
                        ->end()
                        ->scalarNode('publicKey')
                        ->end()
                        ->scalarNode('privateKey')
                        ->end()
                        ->scalarNode('pemFile')
                        ->end()
                        ->scalarNode('pem')
                        ->end()
                    ->end()
                ->end()
                ->integerNode('ttl')
                    ->defaultValue(2419200)
                ->end()
                ->scalarNode('topic')
                    ->defaultNull()
                ->end()
                ->scalarNode('urgency')
                    ->defaultNull()
                ->end()
                ->scalarNode('http_client')
                    ->defaultNull()
                    ->info('Service id of a PSR-18 client to use. Defaults to auto-discovering one already in the container, then falling back to WebPush\'s own auto-discovery.')
                ->end()
                ->booleanNode('automatic_padding')
                    ->defaultValue(true)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
