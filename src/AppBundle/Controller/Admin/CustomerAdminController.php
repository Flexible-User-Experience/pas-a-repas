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

    /// TODO fix legacy code
    /**
     * Rebuts
     */
//    public function executeNewRebut(sfWebRequest $request)
//    {
//        if ($request->isMethod(sfRequest::GET)) {
//            $this->forward404Unless($request->hasParameter('id'));
//            $this->client = ClientTable::getInstance()->find($request->getParameter('id'));
//            $this->forward404Unless($this->client);
//        } else if ($request->isMethod(sfRequest::POST)) {
//            $this->forward404Unless($request->hasParameter('id') && $request->hasParameter('tipo') && $request->hasParameter('mes') && $request->hasParameter('any'));
//            if ($request->getParameter('tipo') == 'particular') {
//                // Proces de facturacio hores particulars
//                $inici = date('Y-m-d', mktime(0, 0, 0, $request->getParameter('mes'), 1, $request->getParameter('any')));
//                $fi    = date('Y-m-d', mktime(23, 59, 59, $request->getParameter('mes'), cal_days_in_month(CAL_GREGORIAN, $request->getParameter('mes'), $request->getParameter('any')), $request->getParameter('any')));
//                $client = ClientTable::getInstance()->find($request->getParameter('id'));
//                if ($client) {
//                    $total = 0;
//                    $quantitat = 0;
//                    //foreach ($clients as $client) {
//                    $import = 0;
//                    $hores = HoraParticularTable::getInstance()->createQuery('h')->where('h.client_id = ? AND h.fecha >= ? AND h.fecha <= ? AND h.facturat = 0', array($client->getId(), $inici, $fi))->execute();
//                    if (count($hores) > 0) {
//                        foreach ($hores as $hora) {
//                            $import = $import + ($hora->getPreu() * $hora->getQuantitat());
//                            $hora->setFacturat(1);
//                            $hora->save();
//                        }
//                        $rebut = new Rebut();
//                        $rebut->setTipo('particular');
//                        $rebut->setImport($import);
//                        $rebut->setClientId($client->getId());
//                        $rebut->setFecha(date('Y-m-d', mktime(0, 0, 0, $request->getParameter('mes'), 1, $request->getParameter('any'))));
//                        $rebut->save();
//                        $total = $total + $import;
//                        $quantitat++;
//                        $this->getUser()->setFlash('msg', "S'ha generat un rebut amb un import facturat total de ".Utils::getImportFormat($total)." â‚¬");
//                    } else {
//                        $this->getUser()->setFlash('msg', "Aquest client no disposa d'hores particulars facturables per aquest perÃ­ode");
//                    }
//                }
//            } else if ($request->getParameter('tipo') == 'grup') {
//                // Proces de facturacio hores en grup
//                $client = ClientTable::getInstance()->find($request->getParameter('id'));
//                if ($client && $client->getClassesEnGrup()) {
//                    $total = 0;
//                    $quantitat = 0;
//                    //foreach ($clients as $client) {
//                    $rebut = new Rebut();
//                    $rebut->setTipo('grup');
//                    $rebut->setImport($client->getPreuMensualEnGrup());
//                    $rebut->setClientId($client->getId());
//                    $rebut->setFecha(date('Y-m-d', mktime(0, 0, 0, $request->getParameter('mes'), 1, $request->getParameter('any'))));
//                    $rebut->save();
//                    $total = $total + $client->getPreuMensualEnGrup();
//                    $quantitat++;
//                    //}
//                    $this->getUser()->setFlash('msg', "S'ha generat un rebut amb un import facturat total de ".Utils::getImportFormat($total)." â‚¬");
//                } else {
//                    $this->getUser()->setFlash('msg', "Aquest client no disposa d'hores en grup facturables");
//                }
//            }
//            $this->client = ClientTable::getInstance()->find($request->getParameter('id'));
//            $this->forward404Unless($this->client);
//        }
//    }
//
//    public function executeCreateRebut(sfWebRequest $request)
//    {
//        $this->forward404Unless($request->isMethod(sfRequest::POST) && $request->hasParameter('id') && $request->hasParameter('tipo') && $request->hasParameter('mes') && $request->hasParameter('any'));
//        if ($request->getParameter('tipo') == 'particular') {
//            // Proces de facturacio hores particulars
//            $inici = date('Y-m-d', mktime(0, 0, 0, $request->getParameter('mes'), 1, $request->getParameter('any')));
//            $fi    = date('Y-m-d', mktime(23, 59, 59, $request->getParameter('mes'), cal_days_in_month(CAL_GREGORIAN, $request->getParameter('mes'), $request->getParameter('any')), $request->getParameter('any')));
//            $client = ClientTable::getInstance()->find($request->getParameter('id'));
//            if ($client) {
//                $total = 0;
//                $quantitat = 0;
//                //foreach ($clients as $client) {
//                $import = 0;
//                $hores = HoraParticularTable::getInstance()->createQuery('h')->where('h.client_id = ? AND h.fecha >= ? AND h.fecha <= ? AND h.facturat = 0', array($client->getId(), $inici, $fi))->execute();
//                if (count($hores) > 0) {
//                    foreach ($hores as $hora) {
//                        $import = $import + ($hora->getPreu() * $hora->getQuantitat());
//                        $hora->setFacturat(1);
//                        $hora->save();
//                    }
//                    $rebut = new Rebut();
//                    $rebut->setTipo('particular');
//                    $rebut->setImport($import);
//                    $rebut->setClientId($client->getId());
//                    $rebut->setFecha(date('Y-m-d', mktime(0, 0, 0, $request->getParameter('mes'), 1, $request->getParameter('any'))));
//                    $rebut->save();
//                    $total = $total + $import;
//                    $quantitat++;
//                }
//                //}
//                $this->getUser()->setFlash('msg', "S'ha generat un rebut amb un import facturat total de ".Utils::getImportFormat($total)." â‚¬");
//            } else {
//                $this->getUser()->setFlash('msg', "Aquest client no disposa d'hores particulars facturables per aquest perÃ­ode");
//            }
//        } else if ($request->getParameter('tipo') == 'grup') {
//            // Proces de facturacio hores en grup
//            $client = ClientTable::getInstance()->find($request->getParameter('id'));
//            if ($client) {
//                $total = 0;
//                $quantitat = 0;
//                //foreach ($clients as $client) {
//                $rebut = new Rebut();
//                $rebut->setTipo('grup');
//                $rebut->setImport($client->getPreuMensualEnGrup());
//                $rebut->setClientId($client->getId());
//                $rebut->setFecha(date('Y-m-d', mktime(0, 0, 0, $request->getParameter('mes'), 1, $request->getParameter('any'))));
//                $rebut->save();
//                $total = $total + $client->getPreuMensualEnGrup();
//                $quantitat++;
//                //}
//                $this->getUser()->setFlash('msg', "S'ha generat un rebut amb un import facturat total de ".Utils::getImportFormat($total)." â‚¬");
//            } else {
//                $this->getUser()->setFlash('msg', "Aquest client no disposa d'hores en grup facturables");
//            }
//        }
//        $this->redirect('client/newRebut');
//    }

    /**
     * @param Request|null $request
     *
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
