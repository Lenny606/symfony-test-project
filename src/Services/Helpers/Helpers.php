<?php

namespace App\Services\Helpers;

use App\Entity\Embeddable\Contact;
use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class Helpers
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function checkEntityExists(string $entity) : bool
    {

        $repository = $this->em->getClassMetadata("App\Entity\Event::class");

        echo $repository->hasField('id');


        return $entity !== [] ?? false;
    }

    public function getAllIdsFromEntity(string $entity) : array
    {
        $repository = $this->em->getRepository("$entity::class");
        $entity = $repository->findAll();
        return $entity;
    }

    public function saveEntity(object $entity) : void
    {
//        $repository = $this->em->getRepository("$entityName::class");
        $this->em->persist($entity);
        $this->em->flush();
    }
}