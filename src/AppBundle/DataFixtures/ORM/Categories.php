<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;


class Categories implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = array(
            'Mòbils',
            'Ordinadors',
            'Teclats',
            'Pantalles',
            'Altaveus',
        );

        foreach ($categories as $title) {
            $category = new Category();
            $category
                ->setTitle($title)
                ->setSlug($title)
                ->setEnabled(1)
                ->setCreatedDate(new \DateTime());
//                ->setPosts($title);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
