<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Contact;

class Contacts extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $titles = array(
            'name1',
            'name2',
        );

        foreach ($titles as $title) {
            $contact = new Contact();
            $contact
                ->setName($title)
                ->setEmail('test@gmail.com')
                ->setPhone($title)
                ->setMessage($title)
                ->setDate(new \DateTime());

            $manager->persist($contact);
        }

        $manager->flush();
    }
}
