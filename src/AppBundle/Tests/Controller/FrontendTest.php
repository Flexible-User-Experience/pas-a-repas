<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\BaseTest;
use AppBundle\Entity\Post;
use AppBundle\Entity\Category;

/**
 * Class FrontendTest
 *
 * @category Test
 * @package  AppBundle\Tests\Controller
 * @author   David Romaní <david@flux.cat>
 */
class FrontendTest extends BaseTest
{
    /**
     * Test HTTP request is successful
     *
     * @dataProvider provideSuccessfulUrls
     * @param string $url
     */
    public function testPagesAreSuccessful($url)
    {
        $client = $this->createClient();
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
            array('/'),
            array('/blog'),
            array('/credits'),
            array('/politica-de-privacitat'),
        );
    }

    /**
     * Test HTTP request is not found
     *
     * @dataProvider provideNotFoundUrls
     * @param string $url
     */
    public function testPagesAreNotFound($url)
    {
        $client = $this->createClient();
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
            array('/this-is-a-broken-route'),
            array('/blog/categoria/this-is-a-broken-route'),
        );
    }

    /**
     * Test
     */
    public function testSuccessfullPaths()
    {
        $posts = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Post')->getAllEnabledSortedByPublishedDate();
        /** @var Post $post */
        $post = $posts[0];
        $client = $this->createClient();
        $client->request('GET', $this->getUrl('blog_detail', array(
            'year' => $post->getPublishedAt()->format('Y'),
            'month' => $post->getPublishedAt()->format('m'),
            'day' => $post->getPublishedAt()->format('d'),
            'slug' => $post->getSlug(),
        )));
        $this->assertStatusCode(200, $client);
        $client->request('GET', $this->getUrl('blog_detail', array(
            'year' => $post->getPublishedAt()->format('Y'),
            'month' => $post->getPublishedAt()->format('m'),
            'day' => $post->getPublishedAt()->format('d'),
            'slug' => 'broken',
        )));
        $this->assertStatusCode(404, $client);
        $categories = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();
        /** @var Category $category */
        $category = $categories[0];
        $client->request('GET', $this->getUrl('category_detail', array(
            'slug' => $category->getSlug(),
        )));
        $this->assertStatusCode(200, $client);
        $client->request('GET', $this->getUrl('category_detail', array(
            'slug' => 'broken',
        )));
        $this->assertStatusCode(404, $client);
    }

    /**
     * Test contact form
     */
    public function testSendContactForm()
    {
        // fetch messages amount before send form
        $messages = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Contact')->findAll();
        $messagesAmountPreSendForm = count($messages);
        $client = $this->createClient();
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
