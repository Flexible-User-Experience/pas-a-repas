<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Contact;
use AppBundle\Form\Type\ContactAnswerType;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class ContactAdminController
 *
 * @category Controller
 * @package  AppBundle\Controller\Admin
 * @author   David Romaní <david@flux.cat>
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
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedHttpException If access is not granted
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

        return $this->render(
            $this->admin->getTemplate('show'),
            array(
                'action' => 'show',
                'object' => $object,
                'elements' => $this->admin->getShow(),
            ),
            null,
            $request
        );
    }

    /**
     * Answer message action.
     *
     * @param int|string|null $id
     * @param Request $request
     *
     * @return Response
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedHttpException If access is not granted
     */
    public function answerAction($id = null, Request $request = null)
    {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());

        /** @var Contact $object */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        $form = $this->createForm(ContactAnswerType::class, $object);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // send notification email
            $mailer = $this->get('app.mailer');
            $mailer->sendEmail(
                $this->container->getParameter('mailer_destination'),
                $object->getEmail(),
                'Resposta formulari de contacte Pas A Repàs',
                $this->renderView(':Admin/Contact:email.html.twig', array('object' => $object))
            );
            // persist new contact message record
            $object->setAnswered(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            // add view flash message
            $this->addFlash('successx', 'frontend.index.main.sent');

            return $this->redirectToRoute('admin_app_contact_list');
        }

        return $this->render(
            '::Admin/Contact/answer_form.html.twig',
            array(
                'action' => 'answer',
                'object' => $object,
                'form' => $form->createView(),
            ),
            null,
            $request
        );
    }

    /**
     * @param Request|null $request
     * @return Request
     */
    private function resolveRequest(Request $request = null)
    {
        if (null === $request) {
            return $this->getRequest();
        }

        return $request;
    }
}
