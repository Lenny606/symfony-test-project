<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetUsersAction
{
   public function __construct()
   {
   }

    #[Route("/api/v1/users", name: "api_users")]
    public function action(): JsonResponse
    {
        //$users = $this->userRepository->findAll();

        return new JsonResponse(['status' => "OK",
            'data' => "d"]);
    }


}