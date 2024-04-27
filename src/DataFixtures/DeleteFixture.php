<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DeleteFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // $product = new Product();
        $qb = $em->createQueryBuilder();
        $qb->select('m')->from(MicroPost::class, 'm');
        $item = $qb->getQuery()->getArrayResult();
        dd($item);
        $lastPosition = count($item) - 1;
        $em->remove($item[$lastPosition]);

        $manager->flush();

    }
}
