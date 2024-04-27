<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates new user account',
)]
class CreateUserCommand extends Command
{
    public function __construct(private UserPasswordHasherInterface $hasher, private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'email')
            ->addArgument('password', InputArgument::REQUIRED, 'pass')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $pass = $input->getArgument('password');

        if (!$email) {
            $io->note(sprintf('arguments missing'));
            return 0;
        }

        if ($pass) {
            $io->note(sprintf('password being made for user: %s', $email));
        } else {
            $io->note(sprintf('password argument missing'));
        }

        $user = new User();
        $user->setEmail($email);
        $user->setRoles([]);
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $pass
            )
        );
        $this->em->persist($user);
        $this->em->flush($user);
//        if ($input->getOption('option1')) {
//            // ...
//        }

        $io->success('New user created!');

        return Command::SUCCESS;
    }
}
