<?php

namespace AppBundle\Tests\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = $this->createClient(array(), array(
            'PHP_AUTH_USER' => $this->getContainer()->getParameter('admin_user'),
            'PHP_AUTH_PW' => $this->getContainer()->getParameter('admin_password'),
        ));

        // Visit admin list view
        $crawler = $client->request('GET', '/admin/contact/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /admin/contact/");

        // Show the entity
        $link = $crawler->selectLink('show')->first()->link();
        $client->click($link);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
