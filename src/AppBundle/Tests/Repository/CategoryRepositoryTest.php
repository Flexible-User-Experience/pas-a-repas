<?php

namespace AppBundle\Tests\Repository;

use AppBundle\Entity\Category;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class CategoryRepositoryTest extends WebTestCase
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
        $enabledCategories = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Category')->getAllEnabledSortedByTitle();

        $allCategories = $this->getContainer()->get('doctrine')->getRepository('AppBundle:Category')->findAll();
        $enabledItems = 0;
        /** @var Category $item */
        foreach ($allCategories as $item) {
            if ($item->getEnabled()) {
                $enabledItems++;
            }
        }

        $this->assertEquals(count($enabledCategories), $enabledItems);
    }
}
