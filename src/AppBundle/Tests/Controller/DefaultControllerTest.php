<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $client->request('GET', '/blog');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $client->request('GET', '/blog/categories');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
