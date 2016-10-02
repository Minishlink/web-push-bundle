<?php

namespace Minishlink\Bundle\WebPushBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
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

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('web_push.yml');

        if (array_key_exists('VAPID', $config)) {
            $auth = array_merge($config['api_keys'], $config['VAPID']);
        } else $auth = $config['api_keys'];

        $container->setParameter('minishlink_web_push.auth', $auth);
        $container->setParameter('minishlink_web_push.ttl', $config['ttl']);
        $container->setParameter('minishlink_web_push.timeout', $config['timeout']);
        $container->setParameter('minishlink_web_push.automatic_padding', $config['automatic_padding']);
    }
}
