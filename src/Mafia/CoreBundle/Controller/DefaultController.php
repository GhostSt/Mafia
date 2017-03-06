<?php

namespace Mafia\CoreBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Mafia\CoreBundle\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        /*
        $user = new User();
        $user->setUsername('GhostSt');
        $user->setEmail('ghostst@mail.ru');
        $user->setPassword('Qwerty');
        $dm->persist($user);
        $dm->flush();
        */
        $users = $dm->getRepository('MafiaCoreBundle:User')->findAll();
        var_dump($users);

        return $this->render('MafiaCoreBundle:Default:index.html.twig');
    }
}
