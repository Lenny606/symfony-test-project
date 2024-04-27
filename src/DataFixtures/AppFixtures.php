<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        //test user
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setRoles([]);
        $user1->setPassword(
            $this->hasher->hashPassword(
                $user1,
                'test'
            )
        );
        //test data
        for ($i = 1; $i <= 10; $i++) {
            $micropost = new MicroPost();
            $micropost->setTitle("MicroPost $i");
            $micropost->setText($this->generateRandomString($i*10));
            $micropost->setAuthor($user1);
            $micropost->setCreatedAt(new \DateTimeImmutable());
            $micropost->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($micropost);
        }

        //test user
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setRoles([]);
        $user1->setPassword(
            $this->hasher->hashPassword(
                $user1,
                'test'
            )
        );

        $user2 = new User();
        $user2->setEmail('test2@test.com');
        $user2->setRoles([]);
        $user2->setPassword(
            $this->hasher->hashPassword(
                $user2,
                'test'
            )
        );

        $manager->persist($user1);
        $manager->persist($user2);
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
