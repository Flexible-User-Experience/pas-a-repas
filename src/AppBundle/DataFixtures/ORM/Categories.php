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
            'Prova1',
            'Prova2',
            'Prova3',
            'Prova4',
            'Prova5',
        );

        foreach ($categories as $title) {
            $category = new Category();
            $category
                ->setTitle($title)
                ->setSlug($title)
                ->setEnabled(1)
                ->setCreatedDate(new \DateTime());

            $manager->persist($category);
        }

        $manager->flush();
    }
}
