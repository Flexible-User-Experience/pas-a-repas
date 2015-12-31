<?php

namespace AppBundle\Tests\Repository;

use AppBundle\Tests\BaseTest;
use AppBundle\Entity\Category;

/**
 * Class CategoryRepositoryTest
 *
 * @category Test
 * @package  AppBundle\Tests\Repository
 * @author   David Romaní <david@flux.cat>
 */
class CategoryRepositoryTest extends BaseTest
{
    /**
     * Test
     */
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
