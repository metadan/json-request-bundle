<?php

namespace SymfonyBundles\JsonRequestBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class JsonRequestExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $listener = new Definition($mergedConfig['listener']['request_transformer']);

        $listener->addTag('kernel.event_listener', [
            'event' => 'kernel.request',
            'method' => 'onKernelRequest',
            'priority' => $mergedConfig['listener']['priority'],
        ]);

        $container->setDefinition('sb_json_request.request_transformer', $listener);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return 'sb_json_request';
    }
}
