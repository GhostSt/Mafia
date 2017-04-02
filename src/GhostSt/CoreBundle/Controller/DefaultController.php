<?php

namespace GhostSt\CoreBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use GhostSt\CoreBundle\Document\Game;
use GhostSt\CoreBundle\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('_login');
    }
}
