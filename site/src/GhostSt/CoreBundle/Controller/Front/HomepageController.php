<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:14
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Controller\Front;

use GhostSt\CoreBundle\Filter\DateFilter;
use GhostSt\CoreBundle\Service\Sorter\RatingSorter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Homepage controller
 */
class HomepageController extends Controller
{
    /**
     * @return Response
     *
     * @Route("/", methods={"GET"})
     */
    public function viewAction(): Response
    {
        $statisticService = $this->get('ghostst_core.service.statistic.general_player');
        // TODO: move to request listener
        $code = 'current_month';

        $filter = new DateFilter(
            $code,
            '2017-10-01',
            '2017-11-01'
        );

        $statistic = $statisticService->calculateStatistic($filter);

        $sorter = new RatingSorter();
        $sorter->sort($statistic);
        /*
        var_dump($statistic);
        die('test');
        */

        return $this->render('GhostStCoreBundle:Front:homepage.html.twig', [
            'statistic' => $statistic
        ]);
    }
}