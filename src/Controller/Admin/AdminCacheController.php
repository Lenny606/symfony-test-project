<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Enums\CacheType;
use App\Form\CommentType;
use App\Form\JsonType;
use App\Services\CachingService;
use App\Services\UserDeleteService;
use Composer\DependencyResolver\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminCacheController extends AbstractController
{
//    #[Route('/user', name: 'app_user')]
//    public function index(): Response
//    {
//        return $this->render('user/index.html.twig', [
//            'controller_name' => 'UserController',
//        ]);
//    }

    #[Route('/admin/cache/delete', name: 'admin_cache_delete')]
    public function delete(Request $request, CachingService $cachingService): Response
    {

//        $cachingService->clearCache();
//        if(!$isInDTB){
//            $this->addFlash('success', 'User deleted');
////        }

        return $this->redirectToRoute('app_user_list');
    }
    #[Route('/admin/cache/save', name: 'admin_cache_save')]
    public function save(Request $request, CachingService $cachingService): Response
    {

        $form = $this->createForm(JsonType::class);
        $form->handleRequest($request);
        $data =  $form->getData();
        $cachingService->save(CacheType::JSON_TYPE, "test.json", $data);


        return $this->redirectToRoute('admin_cache_save');
    }
}
