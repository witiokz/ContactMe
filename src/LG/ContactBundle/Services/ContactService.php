<?php

namespace LG\ContactBundle\Services;

class ContactService
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function saveContact($contact)
    {
        $this->em->persist($contact);
        $this->em->flush();
    }
}
