<?php

namespace GhostSt\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GhostStCoreBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
