<?php

namespace Tests\Minishlink\WebPushBundle\DependencyInjection;

use Minishlink\WebPush\WebPush;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Minishlink\Bundle\WebPushBundle\DependencyInjection\MinishlinkWebPushExtension;

/**
 * Test for the WebPush Extension
 * 
 * @author Tim Bernhard <tim@bernhard-webstudio.ch>
 */
class MinishlinkWebPushExtensionTest extends AbstractExtensionTestCase
{

    protected function getContainerExtensions() {
        return array(
            new MinishlinkWebPushExtension()
        );
    }

    public function testWithoutConfiguration() {
        $this->load();

        $this->assertContainerBuilderHasParameter('minishlink_web_push.auth');
        $this->assertContainerBuilderHasParameter('minishlink_web_push.default_options');
        $this->assertContainerBuilderHasParameter('minishlink_web_push.timeout');
        $this->assertContainerBuilderHasParameter('minishlink_web_push.automatic_padding');
        $this->assertContainerBuilderHasService('minishlink_web_push');
        $this->assertInstanceOf(WebPush::class, $this->container->get('minishlink_web_push'));
    }

}
