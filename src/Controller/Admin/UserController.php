<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Services\UserDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/admin/user/{id<\d+>}/delete', name: 'admin_user_delete')]
    public function delete(User $id, UserDeleteService $userDeleteService): Response
    {
        $isInDTB = $userDeleteService->deleteUser($id);
        if(!$isInDTB){
            $this->addFlash('success', 'User deleted');
        }

        return $this->redirectToRoute('app_user_list');
    }
}
