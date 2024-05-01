<?php

namespace App\Services;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class UserDeleteService
{
    public function __construct(
        private UserRepository         $userRepository,
        private EntityManagerInterface $em)
    {

    }

    public function deleteUser(User $user): bool
    {
        $userToDelete = $this->userRepository->find($user);
        $id = $user->getId();
        try {
            $this->em->remove($userToDelete);
            $this->em->flush();
        } catch (EntityNotFoundException $e) {
            throw new EntityNotFoundException($e->getMessage());
        }

        $deletedUser = $this->userRepository->findBy(['id' => $id]);

        // Return true if the user entity does not exist (i.e., it was successfully deleted)
        return $deletedUser === null;
    }
}