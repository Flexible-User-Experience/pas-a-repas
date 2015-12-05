<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class Categories extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $titles = array(
            'Mòbils',
            'Ordinadors',
            'Teclats',
            'Pantalles',
            'Altaveus',
        );

        foreach ($titles as $title) {
            $category = new Category();
            $category
                ->setTitle($title)
                ->setSlug($title)
                ->setEnabled(1)
                ->setCreatedDate(new \DateTime());

            $manager->persist($category);
        }
        $this->setReference('last-category', $category);

        $manager->flush();
    }
}
