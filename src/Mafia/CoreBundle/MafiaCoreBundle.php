<?php

namespace Mafia\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MafiaCoreBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
