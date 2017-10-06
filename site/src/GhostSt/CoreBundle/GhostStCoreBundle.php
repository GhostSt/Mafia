<?php

namespace GhostSt\CoreBundle;

use GhostSt\CoreBundle\Service\Rating\Strategy\StrategyCompiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GhostStCoreBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

    /**
     * Initialize container
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new StrategyCompiler());
    }
}
