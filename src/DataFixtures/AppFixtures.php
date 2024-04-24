<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 1; $i <= 10; $i++) {
            $micropost = new MicroPost();
            $micropost->setTitle("MicroPost $i");
            $micropost->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($micropost);
        }


        $manager->flush();
    }
}
