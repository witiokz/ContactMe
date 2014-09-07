<?php

namespace LG\ContactBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LG\ContactBundle\Entity\Contact;

class LoadContactData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $contact = new Contact();
        $contact->setName('user1');
        $contact->setEmail('user1@gmail.com');
        $contact->setMessage('user1 text');

        $manager->persist($contact);
        $manager->flush();

        $contact = new Contact();
        $contact->setName('user2');
        $contact->setEmail('user2@gmail.com');
        $contact->setMessage('user2 text');

        $manager->persist($contact);
        $manager->flush();

        $contact = new Contact();
        $contact->setName('user3');
        $contact->setEmail('user3@gmail.com');
        $contact->setMessage('user3 text');

        $manager->persist($contact);
        $manager->flush();
    }
}