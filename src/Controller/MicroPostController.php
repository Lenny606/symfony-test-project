<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Entity\MicroPostFormType;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
    public function showOne(MicroPost $id): Response
    {

        return $this->render('micro_post/show.html.twig', [
            'controller_name' => 'MicroPostController',
            'post' => $id
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $newMP = new MicroPost();

        $form = $this->createForm(MicroPostFormType::class, $newMP);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setCreatedAt(new \DateTimeImmutable());
            $em->persist($data);
            $em->flush();

            $this->addFlash("success", "SAVED");
            return $this->redirectToRoute('app_micro_post');

        }

        return $this->render('form/addPost.html.twig', [
            'form' => $form]);
    }

    #[Route('/micro-post/{id}/edit', name: 'app_micro_post_edit')]
    public function edit(MicroPost $id, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(MicroPostFormType::class, $id);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setUpdatedAt(new \DateTimeImmutable());

            $em->persist($data);
            $em->flush();

            $this->addFlash("success", "Updated");
            return $this->redirectToRoute('app_micro_post');

        }

        return $this->render('form/editPost.html.twig', [
            'form' => $form]);
    }


}
