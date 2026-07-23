<?php

namespace Minishlink\Bundle\WebPushBundle\DependencyInjection;

use Http\Client\HttpAsyncClient;
use Minishlink\WebPush\WebPush;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * MinishlinkWebPushExtension.
 *
 * @author Louis Lagrange <lagrange.louis@gmail.com>
 */
class MinishlinkWebPushExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('web_push.yml');

        $defaultOptions = array(
            'TTL' => $config['ttl'],
            'urgency' => $config['urgency'],
            'topic' => $config['topic'],
        );

        $container->setParameter('minishlink_web_push.auth', isset($config['VAPID']) ? ['VAPID' => $config['VAPID']] : []);
        $container->setParameter('minishlink_web_push.default_options', $defaultOptions);
        $container->setParameter('minishlink_web_push.automatic_padding', $config['automatic_padding']);

        $definition = $container->getDefinition('minishlink_web_push');

        if (null !== $config['http_client']) {
            $definition->setArgument(2, new Reference($config['http_client']));
        } else {
            $definition->setArgument(2, new Reference(ClientInterface::class, ContainerInterface::NULL_ON_INVALID_REFERENCE));
        }

        $definition->setArgument(3, new Reference(RequestFactoryInterface::class, ContainerInterface::NULL_ON_INVALID_REFERENCE));
        $definition->setArgument(4, new Reference(StreamFactoryInterface::class, ContainerInterface::NULL_ON_INVALID_REFERENCE));
        $definition->setArgument(5, new Reference(HttpAsyncClient::class, ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }
}
