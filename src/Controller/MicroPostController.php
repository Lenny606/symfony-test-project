<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Entity\MicroPostFormType;
use App\Enums\Roles;
use App\Repository\MicroPostRepository;
use App\Services\Interface\LoggerInterface;
use App\Services\LoginEmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MicroPostController extends AbstractController
{
    public function __construct(private LoggerInterface $logger,)
    {
    }

    #[Route('/micro-post', name: 'app_micro_post')]
//    #[IsGranted(MicroPost::VIEW)]
    public function index(Request $request, MicroPostRepository $posts, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        //email is sent after login
        $urlFromHeader = $request->headers->get('referer');
        $basename = pathinfo($urlFromHeader)['basename'];
        if ($basename === 'login') {
           try{
               LoginEmailService::sendLoginEmail($mailer, $this->getUser());
           }  catch (TransportExceptionInterface $e) {
               $this->logger->log('Emailer', "Email not sent");
               throw new TransportException($e->getMessage());
           }
        }
//        dd($posts->findAll());
//        $new = new MicroPost();
//        $new->setTitle("NEW");
//        $new->setCreatedAt(new \DateTimeImmutable());
//
//        $em->persist($new);
//        $em->flush();

        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
            'posts' => $posts->findAll() ?? [],
        ]);
    }

    #[Route('/micro-post/{id<\d+>}', name: 'app_micro_post_show')]
    #[IsGranted(MicroPost::VIEW, 'id')]
    public function showOne(MicroPost $id): Response
    {

        return $this->render('micro_post/show.html.twig', [
            'controller_name' => 'MicroPostController',
            'post' => $id
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
//    #[isGranted('IS_AUTHENTICATED_FULLY')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        //access rights - isGranted() or denyAccess() or in Attributes, or in security.yml
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $newMP = new MicroPost();

        $form = $this->createForm(MicroPostFormType::class, $newMP);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setCreatedAt(new \DateTimeImmutable());
            $data->setUpdatedAt(new \DateTimeImmutable());
            $data->setAuthor($this->getUser());
            $em->persist($data);
            $em->flush();

            $this->addFlash("success", "SAVED");
            return $this->redirectToRoute('app_micro_post');

        }

        return $this->render('form/addPost.html.twig', [
            'form' => $form]);
    }

    #[Route('/micro-post/{id}/edit', name: 'app_micro_post_edit')]
    #[IsGranted(MicroPost::EDIT, 'id')]
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
