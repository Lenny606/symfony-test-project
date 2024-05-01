<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(
        AuthenticationUtils $utils,
        MailerInterface     $mailer): Response
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        $email = new TemplatedEmail();
        $email
            ->from("user@example.com")
            ->to("thomas.kravcik@gmail.com")
            ->subject("test")
            ->htmlTemplate('email/login.html.twig')
            ->context(
                ["username" => $this->getUser(),
                    "app_name" => getenv("PROJECT_NAME")
                ]);

        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw new TransportException($e->getMessage());
        }

        return $this->render('login/index.html.twig', [
            'lastUsername' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {

    }
}
