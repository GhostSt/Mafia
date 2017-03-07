<?php

// src/Mafia/CoreBundle/Controller/SecurityController.php

namespace Mafia\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /** 
     * @Route("admin/login",  name="MafiaCoreBundle_admin_login")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function loginAction(Request $request) 
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
        
        return $this->render('MafiaCoreBundle:Security:login.html.twig', array(
            'last_username' => $session->get(Security::LAST_USERNAME),
            'error'         => $error
        ));
    }
}
