<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Post;


class Posts implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $posts = array(
            'Post1',
            'Post2',
            'Post3',
            'Post4',
            'Post5',
        );

        foreach ($posts as $title) {
            $post = new Post();
            $post
                ->setTitle($title)
                ->setSlug($title)
                ->setEnabled(1)
                ->setCreatedDate(new \DateTime())
                ->setPublishedDate(new \DateTime())
                ->setDescription('Hello');

            $manager->persist($post);
        }

        $manager->flush();
    }
}
