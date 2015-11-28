<?php

namespace Minishlink\Bundle\WebPushBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * MinishlinkWebPushExtension.
 *
 * @author Louis Lagrange <lagrange.louis@gmail.com>
 */
class MinishlinkWebPushExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('web_push.xml');

        $container->setParameter('web_push.api_keys', $config['api_keys']);
        $container->setParameter('web_push.ttl', $config['ttl']);
        $container->setParameter('web_push.timeout', $config['timeout']);
    }
}
