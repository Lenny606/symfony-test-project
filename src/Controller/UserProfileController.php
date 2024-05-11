<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\ImgType;
use App\Form\UserProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserProfileController extends AbstractController
{
    #[Route('/user/profile', name: 'app_user_profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profile(
        Request                $request,
        UserRepository         $users,
        TranslatorInterface $translator,
        EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $userProfile = $user?->getUserProfile() ?? new UserProfile();

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

           $message = $translator->trans('saved.success.profile');

            $this->addFlash("success", $message);
            return $this->redirectToRoute('app_user_profile');

        }

        return $this->render('user/user_profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/profile/img', name: 'app_user_profile_img')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function imageUpload(Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(ImgType::class);
        $form->handleRequest($request);

        /** @var $user User */
        $user = $this->getUser();
        $userProfile = $user->getUserProfile() ?? new UserProfile();
        $user->setUserProfile($userProfile); //saves new user profile instance
        $imgDir = $this->getParameter('img_directory');
        $img = $form->get('image')->getData();

        if ($img) {
            $originalPathName = pathinfo(
                $img->getClientOriginalName(), PATHINFO_FILENAME
            );
            $safeImgName = $slugger->slug($originalPathName);
            $newFileName = $safeImgName . "_" . uniqid() . "." . $img->guessExtension();


            try {
                $img->move(
                    $imgDir,
                    $newFileName
                );
            } catch (FileException $e) {

            }

            $userProfile->setImage($newFileName);
            $em->persist($userProfile);
            $em->flush();
            $this->addFlash('success', 'Image saved');

            $this->redirectToRoute('app_user_profile_img');
        }


        return $this->render('user/user_profile_img/profile_img.html.twig', [
            'form' => $form->createView(),
            'img' => $userProfile->getImage(),
            'imgDir' => $imgDir
        ]);
    }
}
