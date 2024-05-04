<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserProfileController extends AbstractController
{
    #[Route('/user/profile', name: 'app_user_profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profile(
        Request $request,
        UserRepository $users,
        EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $userProfile = $user?->getUserProfile() ?? new UserProfile() ;

        $form = $this->createForm(
            UserProfileType::class,
            $userProfile
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setCreatedAt(new \DateTimeImmutable());
            $data->setUpdatedAt(new \DateTimeImmutable());
            $user->setUserProfile($userProfile);

            //save user, cascade relations would save UserProfile too
            $em->persist($user);
            $em->flush();

            $this->addFlash("success", "Profile saved");
            return $this->redirectToRoute('app_user_profile');

        }

        return $this->render('user/user_profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
