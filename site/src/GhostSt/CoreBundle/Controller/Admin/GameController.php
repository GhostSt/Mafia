<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Controller\Admin;

use GhostSt\CoreBundle\Document\Game;
use GhostSt\CoreBundle\Document\GameDay;
use GhostSt\CoreBundle\Exception\AMQPException;
use GhostSt\CoreBundle\Form\Type\GameDayType;
use GhostSt\CoreBundle\Form\Type\GameType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Game controller
 */
class GameController extends CRUDController
{
    /**
     * Views form and performs create action
     *
     * @return RedirectResponse|Response
     *
     * @throws AMQPException
     */
    public function createAction()
    {
        $request       = $this->get('request_stack')->getCurrentRequest();
        $odm           = $this->get('doctrine_mongodb');
        $ratingService = $this->get('ghostst_core.service.rating.rating');

        $game = new Game();

        $form        = $this->createForm(GameType::class, $game);

        $dayForm = $this->createForm(GameDayType::class);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $dm = $odm->getManager();
                $dm->persist($game);
                //$dm->flush();

                $ratingService->createGameRating($game);
                // TODO: remove stub
                die('test');

                return $this->redirectToRoute('admin_ghostst_core_game_list');
            }
        }

        return $this->render('GhostStCoreBundle:Admin/Game:form.html.twig', [
            'form'    => $form->createView(),
            'dayForm' => $dayForm->createView(),
        ]);
    }

    /**
     * Views form and performs update action
     *
     * @param $id
     *
     * @return RedirectResponse|Response
     *
     * @throws NotFoundHttpException
     */
    public function editAction($id = null)
    {
        $request       = $this->get('request_stack')->getCurrentRequest();
        $ratingService = $this->get('ghostst_core.service.rating.rating');

        $odm = $this->get('doctrine_mongodb');

        /** @var Game $game */
        $game = $odm->getRepository('GhostStCoreBundle:Game')
                    ->find($id);

        if (null === $game) {
            throw new NotFoundHttpException("Game not found");
        }

        $form = $this->createForm(GameType::class, $game);

        $dayForm = $this->createForm(GameDayType::class);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $dm = $odm->getManager();
                $dm->persist($game);
                $dm->flush();

                $ratingService->updateGameRating($game);

                return $this->redirectToRoute('admin_ghostst_core_game_list');
            }
        }

        return $this->render('GhostStCoreBundle:Admin/Game:form.html.twig', [
            'form'    => $form->createView(),
            'dayForm' => $dayForm->createView(),
        ]);
    }
}