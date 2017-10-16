<?php

namespace GhostSt\CoreBundle;

use GhostSt\CoreBundle\Service\Rating\Strategy\StrategyCompiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Core bundle
 */
class GhostStCoreBundle extends Bundle
{
    /**
     * Return parent module
     *
     * @return string
     */
    public function getParent(): string
    {
        return 'FOSUserBundle';
    }

    /**
     * Initialize container
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new StrategyCompiler());
    }
}
