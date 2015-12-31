<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Contact;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Custom controller.
 */
class ContactAdminController extends Controller
{
    /**
     * Show action.
     *
     * @param int|string|null $id
     * @param Request $request
     *
     * @return Response
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function showAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Contact $object */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $object->setChecked(true);
        $this->admin->checkAccess('show', $object);

        $preResponse = $this->preShow($request, $object);
        if ($preResponse !== null) {
            return $preResponse;
        }

        $this->admin->setSubject($object);

        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();

        return $this->render($this->admin->getTemplate('show'), array(
            'action' => 'show',
            'object' => $object,
            'elements' => $this->admin->getShow(),
        ), null, $request);
    }

    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }
}
