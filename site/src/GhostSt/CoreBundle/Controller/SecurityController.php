<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Security controller
 */
class SecurityController extends Controller
{
    /**
     * Views login form
     *
     * @Route("admin/login",  name="GhostStCoreBundle_admin_login")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function loginAction(Request $request): Response
    {
        $session = $request->getSession();

        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } elseif ($session->has(Security::AUTHENTICATION_ERROR)) {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        } else {
            $error = "";
        }
        
        return $this->render('GhostStCoreBundle:Security:login.html.twig', array(
            'last_username' => $session->get(Security::LAST_USERNAME),
            'error'         => $error
        ));
    }
}
