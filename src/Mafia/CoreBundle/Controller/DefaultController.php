<?php

namespace Mafia\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MafiaCoreBundle:Default:index.html.twig');
    }
}
