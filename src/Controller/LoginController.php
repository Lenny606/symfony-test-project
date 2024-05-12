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

        Request $request
        ): Response
    {
        $error = $this->utils->getLastAuthenticationError();
        $lastUsername = $this->utils->getLastUsername();

        $this->logger->access("User $lastUsername logged in " . (new \DateTime())->format('Y-m-d H:i:s'));


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
