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
        $dm = $this->get('doctrine_mongodb')->getManager();
        /*
        $user = new User();
        $user->setUsername('GhostSt');
        $user->setEmail('ghostst@mail.ru');
        $user->setPassword('Qwerty');
        $dm->persist($user);
        $dm->flush();
        */
        $users = $dm->getRepository('GhostStCoreBundle:User')->findAll();
        var_dump($users);

        $userRoles = $dm->getRepository('GhostStCoreBundle:UserRole')->findAll();
        var_dump($userRoles);

        $games = $dm->getRepository('GhostStCoreBundle:Game')->findAll();
        /** @var Game $game */
        $game = $games[0];

        var_dump($game);

        return $this->render('GhostStCoreBundle:Default:index.html.twig');
    }
}
