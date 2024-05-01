<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use App\Services\UserDeleteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserListController extends AbstractController
{
    #[Route('/admin/user/list', name: 'app_user_list')]
    public function index(UserRepository $users): Response
    {
        $userList = $users->findAll();
        return $this->render('admin/users/users.html.twig', [
            'userList' => $userList
        ]);
    }
}
