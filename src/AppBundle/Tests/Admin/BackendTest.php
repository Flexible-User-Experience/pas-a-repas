<?php

namespace AppBundle\Tests\Admin;

use AppBundle\Tests\BaseTest;

/**
 * Class BackendTest
 *
 * @category Test
 * @package  AppBundle\Tests\Admin
 * @author   David Romaní <david@flux.cat>
 */
class BackendTest extends BaseTest
{
    /**
     * Test admin login request is successful
     */
    public function testAdminLoginPageIsSuccessful()
    {
        $client = $this->createClient();           // anonymous user
        $client->request('GET', '/admin/login');

        $this->assertStatusCode(200, $client);
    }

    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideSuccessfulUrls
     * @param string $url
     */
    public function testAdminPagesAreSuccessful($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(200, $client);
    }

    /**
     * Successful Urls provider
     *
     * @return array
     */
    public function provideSuccessfulUrls()
    {
        return array(
            array('/admin/dashboard'),
            array('/admin/web/missatge/list'),
            array('/admin/web/missatge/1/show'),
            array('/admin/web/missatge/1/answer'),
            array('/admin/web/missatge/1/delete'),
            array('/admin/web/categoria/list'),
            array('/admin/web/categoria/create'),
            array('/admin/web/categoria/1/show'),
            array('/admin/web/categoria/1/edit'),
            array('/admin/web/categoria/1/delete'),
            array('/admin/web/article/list'),
            array('/admin/web/article/create'),
            array('/admin/web/article/1/edit'),
            array('/admin/web/article/1/delete'),
            array('/admin/facturacio/parte/list'),
            array('/admin/facturacio/parte/create'),
            array('/admin/facturacio/parte/1/edit'),
            array('/admin/facturacio/parte/1/delete'),
            array('/admin/facturacio/alumne/create'),
            array('/admin/facturacio/alumne/1/edit'),
            array('/admin/facturacio/alumne/1/delete'),
            array('/admin/facturacio/telefon/create'),
            array('/admin/facturacio/telefon/1/edit'),
            array('/admin/facturacio/telefon/1/delete'),
            array('/admin/facturacio/telefon/list'),
            array('/admin/despesa/despesa/list'),
            array('/admin/despesa/despesa/create'),
            array('/admin/despesa/despesa/1/edit'),
            array('/admin/despesa/despesa/1/delete'),
            array('/admin/despesa/categoria/list'),
            array('/admin/despesa/categoria/create'),
            array('/admin/despesa/categoria/1/edit'),
            array('/admin/despesa/categoria/1/delete'),
            array('/admin/administrador/usuari/list'),
            array('/admin/administrador/usuari/create'),
            array('/admin/administrador/usuari/1/edit'),
            array('/admin/administrador/usuari/1/delete'),
        );
    }

    /**
     * Test HTTP request is not found
     *
     * @dataProvider provideNotFoundUrls
     * @param string $url
     */
    public function testAdminPagesAreNotFound($url)
    {
        $client = $this->makeClient(true);         // authenticated user
        $client->request('GET', $url);

        $this->assertStatusCode(404, $client);
    }

    /**
     * Not found Urls provider
     *
     * @return array
     */
    public function provideNotFoundUrls()
    {
        return array(
            array('/admin/web/missatge/create'),
            array('/admin/web/missatge/1/edit'),
            array('/admin/web/missatge/batch'),
            array('/admin/web/categoria/batch'),
            array('/admin/web/article/batch'),
            array('/admin/facturacio/parte/1/show'),
            array('/admin/facturacio/parte/batch'),
            array('/admin/facturacio/alumne/1/show'),
            array('/admin/facturacio/alumne/batch'),
            array('/admin/facturacio/telefon/1/show'),
            array('/admin/facturacio/telefon/batch'),
            array('/admin/despesa/despesa/1/show'),
            array('/admin/despesa/despesa/batch'),
            array('/admin/despesa/categoria/1/show'),
            array('/admin/despesa/categoria/batch'),
            array('/admin/administrador/usuari/show'),
            array('/admin/administrador/usuari/batch'),
        );
    }
}
