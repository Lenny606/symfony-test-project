<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
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
            $micropost->setText($this->generateRandomString($i*10));
            $micropost->setCreatedAt(new \DateTimeImmutable());
            $micropost->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($micropost);
        }


        $manager->flush();
    }



    private function generateRandomString($length = 50): string
    {
        $words = ['apple', 'banana', 'orange', 'grape', 'pear', 'peach', 'strawberry', 'blueberry', 'kiwi', 'pineapple', 'watermelon', 'melon', 'cherry', 'lemon', 'lime', 'coconut', 'avocado', 'mango', 'papaya', 'fig', 'plum', 'apricot', 'nectarine', 'raspberry', 'blackberry'];
        $randomString = '';
        $maxIndex = count($words) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $words[random_int(0, $maxIndex)] . ' ';
        }
        return trim($randomString);
    }
}
