<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:14
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Controller\Front;

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
        $
        die('test');
    }
}