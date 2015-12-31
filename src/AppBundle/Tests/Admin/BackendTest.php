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
            array('/admin/web/contacte/list'),
            array('/admin/web/contacte/1/show'),
            array('/admin/web/categoria/list'),
            array('/admin/web/categoria/create'),
            array('/admin/web/categoria/1/edit'),
            array('/admin/web/categoria/1/delete'),
            array('/admin/web/article/list'),
            array('/admin/web/article/create'),
            array('/admin/web/article/1/edit'),
            array('/admin/web/article/1/delete'),
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
            array('/admin/web/contacte/create'),
            array('/admin/web/contacte/1/edit'),
            array('/admin/web/contacte/1/delete'),
            array('/admin/web/contacte/batch'),
            array('/admin/web/categoria/1/show'),
            array('/admin/web/categoria/batch'),
            array('/admin/web/article/1/show'),
            array('/admin/web/article/batch'),
        );
    }
}
