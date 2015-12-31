<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\BaseTest;
use AppBundle\Entity\Post;

/**
 * Class DefaultControllerTest
 *
 * @category Test
 * @package  AppBundle\Tests\Admin
 * @author   David Romaní <david@flux.cat>
 */
class DefaultControllerTest extends BaseTest
{
    /**
     * Test
     */
    public function testSuccessfullPaths()
    {
        $client = static::makeClient();
        $client->request('GET', '/');
        $this->assertStatusCode(200, $client);
        $client->request('GET', '/blog');
        $this->assertStatusCode(200, $client);
        /** @var Post $post */
//        $post = $this->fixtures->getReference('last-post');
//        $client->request('GET', "/blog/" . $post->getPublishedDate()->format('Y/m/d') . "/" . $post->getSlug());
//        $this->assertStatusCode(200, $client);
//        $categorySlug = $this->fixtures->getReference('first-category')->getSlug();
//        $client->request('GET', "/blog/categoria/$categorySlug");
//        $this->assertStatusCode(200, $client);
//        $categorySlug = $this->fixtures->getReference('last-category')->getSlug();
//        $client->request('GET', "/blog/categoria/$categorySlug");
//        $this->assertStatusCode(200, $client);
    }

    public function testWrongPaths()
    {
        $client = static::makeClient();
        $client->request('GET', '/this-is-a-broken-route');
        $this->assertStatusCode(404, $client);
        $client->request('GET', '/blog/this-is-a-broken-route');
        $this->assertStatusCode(404, $client);
        /** @var Post $post */
//        $post = $this->fixtures->getReference('last-post');
//        $client->request('GET', "/blog/" . $post->getPublishedDate()->format('Y/m/') . "0/" . $post->getSlug());
//        $this->assertStatusCode(404, $client);
        $client->request('GET', '/blog/categoria/this-is-a-broken-route');
        $this->assertStatusCode(404, $client);
    }

    public function testSendContactForm()
    {
        // fetch messages amount before send form
        $messages = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Contact')->findAll();
        $messagesAmountPreSendForm = count($messages);
        $client = static::makeClient();
        $crawler = $client->request('GET', '/');
        // fill contact form and submit it
        $form = $crawler->selectButton('enviar')->form(array(
            'contact[name]' => 'fake name',
            'contact[email]' => 'test@test.com',
            'contact[phone]' => 'fake phone',
            'contact[message]' => 'fake message',
        ));
        $client->submit($form);
        // fetch messages again and check if there is an increment
        $messages = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Contact')->findAll();
        $this->assertEquals(count($messages), $messagesAmountPreSendForm + 1);
    }
}
