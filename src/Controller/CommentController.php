<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentController extends AbstractController
{

    #[Route('/micro-post/{id}/comment', name: 'app_micro_comment_add')]
    public function add(MicroPost $post, Request $request,EntityManagerInterface $em): Response
    {
        $newComment = new Comment();

        $form = $this->createForm(CommentType::class, $newComment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setCreatedAt(new \DateTimeImmutable());
            $data->setUpdatedAt(new \DateTimeImmutable());
            $data->setMicroPost($post);
            $data->setAuthor($this->getUser());

            $em->persist($data);
            $em->flush();

            $this->addFlash("success", "Comment SAVED");
            return $this->redirectToRoute('app_micro_post_show', [
                'id' => $post->getId()
            ]);

        }

        return $this->render('comment/addComment.html.twig', [
            'form' => $form,
            'post' => $post
            ]);
    }

}
