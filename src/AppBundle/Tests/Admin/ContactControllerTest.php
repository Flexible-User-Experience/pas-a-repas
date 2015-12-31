<?php

namespace AppBundle\Tests\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

/**
 * Class ContactControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests\Admin
 * @author   David Romaní <david@flux.cat>
 */
class ContactControllerTest extends WebTestCase
{
    /**
     * Set up tests
     */
    public function setUp()
    {
        $this->loadFixtures(array(
            'AppBundle\DataFixtures\ORM\Contacts',
        ));
    }

    /**
     * Test admins
     */
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = $this->createClient(array(), array(
            'PHP_AUTH_USER' => $this->getContainer()->getParameter('admin_user'),
            'PHP_AUTH_PW' => $this->getContainer()->getParameter('admin_password'),
        ));

        // Visit admin list view
        $crawler = $client->request('GET', '/admin/web/contacte/list');
        $this->assertStatusCode(200, $client);

        // Check amount of table list items
        $items = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Contact')->findAll();
        $rows = $crawler->filter('tbody')->first()->children();
        $this->assertEquals(count($items), $rows->count());
    }
}
