<?php

namespace App\Command;

use App\Services\Helpers\Helpers;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:convert-ids',
    description: 'Converts entity id to uuid',
)]
class ConvertIdsToUUIDsCommand extends Command
{
    public function __construct(private Helpers $helpers)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('entity', InputArgument::REQUIRED, 'Entity name')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $entity = $input->getArgument('entity');

        if (!$entity) {
            $io->note(sprintf('You passed no name of Entity'));
        }

        $exists = $this->helpers->checkEntityExists($entity);
        if (!$exists) {
            $io->note(sprintf('There is no  Entity of name "%s"', $entity));
        }

        $entities = $this->helpers->getAllIdsFromEntity($entity);
        foreach ($entities as $entity) {
            $uuid = Uuid::uuid4();
            $entity['id'] = $uuid;
            $this->helpers->saveEntity($entity);
        }


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
