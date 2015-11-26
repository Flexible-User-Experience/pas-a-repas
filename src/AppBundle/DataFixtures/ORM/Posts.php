<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Post;
use GitElephant\Objects\Object;
use Symfony\Component\Validator\Constraints\DateTime;


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

        $now = new \DateTime();

        foreach ($posts as $title) {
            $value = rand(0, 1) == 1;
            $post = new Post();
            $post
                ->setTitle($title)
                ->setSlug($title)
                ->setEnabled($value)
                ->setCreatedDate($now)
                ->setPublishedDate($now)
                ->setDescription($this->generateRandomString(1000));

            $manager->persist($post);
        }

        $manager->flush();
    }

    private function generateRandomString($length)
    {
        $characters = '0 123 456789abcd efghijklmn opqrstuvw xyzABCDEF GHIJKLMNO PQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
