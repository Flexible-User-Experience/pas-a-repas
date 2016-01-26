<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Customer;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class CustomerAdminController
 *
 * @category Controller
 * @package  AppBundle\Controller\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class CustomerAdminController extends Controller
{
    /**
     * Customer show action.
     *
     * @param int|string|null $id
     * @param Request $request
     *
     * @return Response
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedHttpException If access is not granted
     */
    public function showAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Customer $object */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        //TODO fix render

//        return $this->redirectToRoute(
//            'admin_app_receipt_edit',
//            array(
//                'year'  => $object->getPublishedAt()->format('Y'),
//                'month' => $object->getPublishedAt()->format('m'),
//                'day'   => $object->getPublishedAt()->format('d'),
//                'slug'  => $object->getSlug(),
//            )
//        );
    }

    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }

}
