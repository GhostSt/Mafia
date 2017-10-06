<?php

namespace Tests\GhostSt\CoreBundle\Controller\Admin;

use Tests\GhostSt\CoreBundle\AbstractControllerTest;

class GameControllerTest extends AbstractControllerTest
{
    public function test()
    {
        $response = $this->post($this->getUrl(1));
    }

    private function getUrl($id)
    {
        return sprintf('/admin/ghostst/core/game/%s/edit', $id);
    }
}
