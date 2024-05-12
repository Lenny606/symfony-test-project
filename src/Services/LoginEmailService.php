<?php

namespace App\Services;


use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class LoginEmailService
{

    public static function sendLoginEmail(MailerInterface $mailer, UserInterface $user) : void
    {

        $email = new TemplatedEmail();
            $email
                ->from("user@example.com")
                ->to("thomas.kravcik@gmail.com")
                ->subject("Login successfully")
                ->htmlTemplate('email/login.html.twig')
                ->context(
                    ["username" => $user->getEmail(),
                        "app_name" => getenv("PROJECT_NAME")
                    ]);

            $mailer->send($email);
    }


}