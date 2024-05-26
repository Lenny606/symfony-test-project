<?php

namespace App\Controller;


use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/event/add', name: 'app_admin_event')]
    public function add(Request $request, EntityManagerInterface $em, EventRepository $eventRepository): Response
    {
        $form = $this->createForm(EventType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setCreatedAt(new \DateTimeImmutable());
            $data->setUpdatedAt(new \DateTimeImmutable());

            $em->persist($data);
            $em->flush();

            $this->addFlash("success", "Save");
            return $this->redirectToRoute('app_admin_event');

        }

        return $this->render('admin/event/addEvent.html.twig', [
            'controller_name' => 'EventController',
            'form' => $form->createView()
        ]);
    }
}
