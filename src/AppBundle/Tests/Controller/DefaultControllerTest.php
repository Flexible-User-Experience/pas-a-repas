<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /** @var mixed */
    protected $fixtures;

    /**
     * Set up tests
     */
    public function setUp()
    {
        $this->fixtures = $this->loadFixtures(array(
            'AppBundle\DataFixtures\ORM\Categories',
            'AppBundle\DataFixtures\ORM\Posts',
        ))->getReferenceRepository();
    }

    public function testSuccessfullPaths()
    {
        $client = static::makeClient();
        $client->request('GET', '/');
        $this->assertStatusCode(200, $client);
        $client->request('GET', '/blog');
        $this->assertStatusCode(200, $client);
        $postSlug = $this->fixtures->getReference('last-post')->getSlug();
        $client->request('GET', "/blog/0000/00/00/$postSlug");
        $this->assertStatusCode(200, $client);
        $categorySlug = $this->fixtures->getReference('first-category')->getSlug();
        $client->request('GET', "/blog/categoria/$categorySlug");
        $this->assertStatusCode(200, $client);
        $categorySlug = $this->fixtures->getReference('last-category')->getSlug();
        $client->request('GET', "/blog/categoria/$categorySlug");
        $this->assertStatusCode(200, $client);
    }

    public function testWrongPaths()
    {
        $client = static::makeClient();
        $client->request('GET', '/this-is-a-broken-route');
        $this->assertStatusCode(404, $client);
        $client->request('GET', '/blog/this-is-a-broken-route');
        $this->assertStatusCode(404, $client);
        $client->request('GET', '/blog/categoria/this-is-a-broken-route');
        $this->assertStatusCode(404, $client);
    }
}
