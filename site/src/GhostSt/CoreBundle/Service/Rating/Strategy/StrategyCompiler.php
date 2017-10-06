<?php

namespace GhostSt\CoreBundle\Service\Rating\Strategy;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Strategy compiler
 */
class StrategyCompiler implements CompilerPassInterface
{
    /**
     * Initialize configuration
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $provider = $container->findDefinition('ghostst_core.service.rating.strategy.aggregator');
        $services = $container->findTaggedServiceIds('rating.strategy');

        foreach($services as $service => $parameters) {
            $provider->addMethodCall('addStrategy', [new Reference($service)]);
        }
    }
}
