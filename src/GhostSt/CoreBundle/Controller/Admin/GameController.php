<?php

// src/GhostSt/CoreBundle/Controller/GameController.php

namespace GhostSt\CoreBundle\Controller\Admin;

use GhostSt\CoreBundle\Document\Game;
use GhostSt\CoreBundle\Form\Type\GameType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GameController extends CRUDController
{
    public function create1Action()
    {
        $game = new Game();

        $form = $this->createForm(GameType::class, $game);

        return $this->render('GhostStCoreBundle:Admin/Game:form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     */
    public function updateAction($id)
    {
        $odm = $this->get('doctrine_mongodb');

        $game = $odm->getRepository('GhostStCoreBundle:Game')
            ->find($id);

        if (null === $game) {
            throw new HttpException(404, "Game not found");
        }

        $form = $this->createForm(GameType::class, $game);

        return $this->render('GhostStCoreBundle:Admin/Game:form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}