<?php

namespace App\Controller;

use App\Services\Interface\LoggerInterface;
use App\Services\Logger;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function __construct(
        private LoggerInterface $logger,
        private  AuthenticationUtils $utils
    )
    {

    }

    #[Route('/login', name: 'app_login')]
    public function index(
        MailerInterface     $mailer,
        Request $request
        ): Response
    {
        $error = $this->utils->getLastAuthenticationError();
        $lastUsername = $this->utils->getLastUsername();

        $this->logger->access("User $lastUsername logged in " . (new \DateTime())->format('Y-m-d H:i:s'));

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
            $this->logger->log('Emailer', "Email not sent");
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
        $lastUsername = $this->utils->getLastUsername();
        $this->logger->access("User $lastUsername log out in " . (new \DateTime())->format('Y-m-d H:i:s'));
    }
}
