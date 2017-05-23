<?php

// src/GhostSt/CoreBundle/Controller/Admin/GameController.php

namespace GhostSt\CoreBundle\Controller\Admin;

use GhostSt\CoreBundle\Document\Game;
use GhostSt\CoreBundle\Document\GameDay;
use GhostSt\CoreBundle\Exception\AMQPException;
use GhostSt\CoreBundle\Form\Type\GameType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class GameController extends CRUDController
{
    /**
     * @return RedirectResponse|Response
     *
     * @throws AMQPException
     */
    public function createAction()
    {
        $request = $this->get('request_stack')->getCurrentRequest();

        $odm = $this->get('doctrine_mongodb');

        $game = new Game();

        $form        = $this->createForm(GameType::class, $game);
        $tmpDocument = new Game();
        $tmpDocument->addDay(new GameDay());
        $tmpForm = $this->createForm(GameType::class);
        $tmpForm->setData($tmpDocument);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $dm = $odm->getManager();
                $dm->persist($game);
                $dm->flush();

                $AMQPManager = $this->get('ghostst_core.service.amqp_manager');
                $AMQPManager
                    ->getChannel()
                    ->declareQueue('games')
                    ->setMessage([
                        'gameId' => $game->getId(),
                    ])
                    ->basicPublish()
                    ->closeChannel()
                    ->closeConnection();

                return $this->redirectToRoute('admin_ghostst_core_game_list');
            }
        }

        return $this->render('GhostStCoreBundle:Admin/Game:form.html.twig', [
            'form'    => $form->createView(),
            'tmpForm' => $tmpForm->createView(),
        ]);
    }

    /**
     * @param $id
     *
     * @return RedirectResponse|Response
     * @throws AMQPException
     * @throws HttpException
     */
    public function editAction($id = null)
    {
        $request = $this->get('request_stack')->getCurrentRequest();

        $odm = $this->get('doctrine_mongodb');

        /** @var Game $game */
        $game = $odm->getRepository('GhostStCoreBundle:Game')
                    ->find($id);

        if (null === $game) {
            throw new HttpException(404, "Game not found");
        }

        $form = $this->createForm(GameType::class, $game);

        $tmpDocument = new Game();
        $tmpDocument->addDay(new GameDay());
        $tmpForm = $this->createForm(GameType::class);
        $tmpForm->setData($tmpDocument);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $dm = $odm->getManager();
                $dm->persist($game);
                $dm->flush();

                $AMQPManager = $this->get('ghostst_core.service.amqp_manager');
                $AMQPManager
                    ->getChannel()
                    ->declareQueue('games')
                    ->setMessage([
                        'gameId' => $game->getId(),
                    ])
                    ->basicPublish()
                    ->closeChannel()
                    ->closeConnection();

                return $this->redirectToRoute('admin_ghostst_core_game_list');
            }
        }

        return $this->render('GhostStCoreBundle:Admin/Game:form.html.twig', [
            'form'    => $form->createView(),
            'tmpForm' => $tmpForm->createView(),
        ]);
    }
}