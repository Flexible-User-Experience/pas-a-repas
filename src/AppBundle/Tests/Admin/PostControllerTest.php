<?php

namespace AppBundle\Tests\Admin;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

/**
 * Class PostControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests\Admin
 * @author   David Romaní <david@flux.cat>
 */
class PostControllerTest extends WebTestCase
{
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

        // Create a new entry in the database
        $crawler = $client->request('GET', '/admin/web/article/list');
        $this->assertStatusCode(200, $client);

        // Check amount of table list items
        $items = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Post')->findAll();
        $rows = $crawler->filter('tbody')->first()->children();
        $this->assertEquals(count($items), $rows->count());

        // Fill in the form and submit it
        $crawler = $client->click($crawler->selectLink('Afegeix')->link());
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_post[title]' => 'Test',
            'appbundle_post[description]' => 'Test',
            'appbundle_post[publishedDate]' => '2001-01-01',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Editar')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'appbundle_post[title]' => 'Foo',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
