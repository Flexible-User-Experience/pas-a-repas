<?php

namespace AppBundle\Tests\Repository;

use AppBundle\Tests\BaseTest;
use AppBundle\Entity\Post;

/**
 * Class PostRepositoryTest
 *
 * @category Test
 * @package  AppBundle\Tests\Repository
 * @author   David Romaní <david@flux.cat>
 */
class PostRepositoryTest extends BaseTest
{
    /**
     * Test
     */
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
