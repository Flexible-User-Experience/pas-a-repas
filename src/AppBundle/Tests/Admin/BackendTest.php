<?php

namespace AppBundle\Tests\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Class AdminsTest
 *
 * @category Test
 * @package  AppBundle\Tests\Admin
 * @author   David Romaní <david@flux.cat>
 */
class AdminsTest extends WebTestCase
{
    /**
     * Set up test
     */
    public function setUp()
    {
        $this->loadFixtures(array('AppBundle\DataFixtures\ORM\LoadFixtures'));
    }

    /**
     * Test admin login request is successful
     */
    public function testAdminLoginPageIsSuccessful()
    {
        $client = static::createClient();
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
        $client = $this->getAuthenticadedUser();
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
            array('/admin/plantas/bandeja/list'),
            array('/admin/plantas/bandeja/create'),
            array('/admin/plantas/bandeja/1/edit'),
            array('/admin/plantas/diametro/list'),
            array('/admin/plantas/diametro/create'),
            array('/admin/plantas/diametro/1/edit'),
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
        $client = $this->getAuthenticadedUser();
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
            array('/admin/plantas/bandeja/1/show'),
            array('/admin/plantas/bandeja/1/delete'),
            array('/admin/plantas/bandeja/batch'),
            array('/admin/plantas/diametro/1/show'),
            array('/admin/plantas/diametro/1/delete'),
        );
    }

    /**
     * Test HTTP request is redirection
     *
     * @dataProvider provideRedirectionUrls
     * @param string $url
     */
    public function testAdminPagesArRedirection($url)
    {
        $client = $this->getAuthenticadedUser();
        $client->request('GET', $url);

        $this->assertStatusCode(302, $client);
    }

    /**
     * Redirection Urls provider
     *
     * @return array
     */
    public function provideRedirectionUrls()
    {
        return array(
            array('/admin/ventas/oferta/1/duplicate'),
            array('/admin/ventas/albaran/1/check-in'),
            array('/admin/ventas/factura/1/charge'),
        );
    }

    /**
     * Get authenticated user with Liip Funcitonal Test Bundle
     *
     * @return Client
     */
    private function getAuthenticadedUser()
    {
        return static::makeClient(true);
    }
}
