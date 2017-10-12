<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Controller\Admin\Tools;

use GhostSt\CoreBundle\Form\Type\Tools\Setting\SerializedSettingType;
use GhostSt\CoreBundle\Helper\RoleHelper;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SettingController extends CRUDController
{
    /**
     * @param $id
     *
     * @return RedirectResponse|Response
     *
     * @throws NotFoundHttpException
     */
    public function editAction($id = null)
    {
        $request        = $this->get('request_stack')->getCurrentRequest();
        $settingService = $this->get('ghostst_core.service.tools.setting');
        $roleService    = $this->get('ghostst_core.service.role.player_role');

        if (null === $setting = $settingService->getById($id)) {
            throw new NotFoundHttpException('Setting hasn\'t been found');
        }

        $rolesView = RoleHelper::getCollectionTypeViewForm($roleService->all());

        $form = $this->createForm(SerializedSettingType::class, $setting, ['allowed_options' => $rolesView]);

        if ($request->getMethod() === Request::METHOD_POST) {
            $form->handleRequest($request);

            $settingService->save($setting);

            return $this->redirectToRoute('admin_ghostst_core_tools_setting_list');
        }

        return $this->render('GhostStCoreBundle:Admin/Tools/Setting:form.html.twig', [
            'form'    => $form->createView(),
            'setting' => $setting,
        ]);
    }
}
