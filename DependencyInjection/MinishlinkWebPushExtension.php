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

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('web_push.yml');

        $defaultOptions = array(
            'TTL' => $config['ttl'],
            'urgency' => $config['urgency'],
            'topic' => $config['topic'],
        );

        if (array_key_exists('VAPID', $config)) {
            $auth = array_merge($config['api_keys'], array('VAPID' => $config['VAPID']));
        } else {
            $auth = $config['api_keys'];
        }

        $container->setParameter('minishlink_web_push.auth', $auth);
        $container->setParameter('minishlink_web_push.default_options', $defaultOptions);
        $container->setParameter('minishlink_web_push.timeout', $config['timeout']);
        $container->setParameter('minishlink_web_push.automatic_padding', $config['automatic_padding']);
    }
}
