<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts, EntityManagerInterface $em): Response
    {

//        dd($posts->findAll());
//        $new = new MicroPost();
//        $new->setTitle("NEW");
//        $new->setCreatedAt(new \DateTimeImmutable());
//
//        $em->persist($new);
//        $em->flush();

        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
            'posts' => $posts->findAll(),
        ]);
    }

    #[Route('/micro-post/{id<\d+>}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $id) :Response
    {

        return $this->render('micro_post/show.html.twig', [
            'controller_name' => 'MicroPostController',
            'post' => $id
        ]);
    }



}
