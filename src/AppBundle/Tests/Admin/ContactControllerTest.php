<?php

namespace AppBundle\Tests\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

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

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = $this->createClient(array(), array(
            'PHP_AUTH_USER' => $this->getContainer()->getParameter('admin_user'),
            'PHP_AUTH_PW' => $this->getContainer()->getParameter('admin_password'),
        ));

        // Visit admin list view
        $crawler = $client->request('GET', '/admin/contact/');
        $this->assertStatusCode(200, $client);

        // Show the entity
        $link = $crawler->selectLink('Mostrar')->first()->link();
        $client->click($link);
        $this->assertStatusCode(200, $client);
    }
}
