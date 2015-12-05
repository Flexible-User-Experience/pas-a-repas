<?php

namespace AppBundle\Tests\Repository;

use AppBundle\Entity\Post;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class PostRepositoryTest extends WebTestCase
{
    /**
     * Set up tests
     */
    public function setUp()
    {
        $this->loadFixtures(array(
            'AppBundle\DataFixtures\ORM\Categories',
            'AppBundle\DataFixtures\ORM\Posts',
        ));
    }

    public function testEnabled()
    {
        $enabledPosts = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Post')->getAllEnabledSortedByPublishedDate();

        $allPosts = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Post')->findAll();
        $enabledItems = 0;
        /** @var Post $item */
        foreach ($allPosts as $item) {
            if ($item->getEnabled()) {
                $enabledItems++;
            }
        }

        $this->assertEquals(count($enabledPosts), $enabledItems);
    }
}
