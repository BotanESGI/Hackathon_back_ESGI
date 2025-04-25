<?php

namespace App\Command;

use App\Service\MeilisearchService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:meilisearch:index',
    description: 'Initialize Meilisearch index and index existing hotels',
    hidden: false
)]
class MeilisearchIndexCommand extends Command
{
    public function __construct(
        private MeilisearchService $meilisearchService
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setHelp('This command creates the hotels index and indexes all existing hotels');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Creating hotels index...');
        $this->meilisearchService->createHotelIndex();
        $output->writeln('Index created successfully!');

        $output->writeln('Indexing hotels...');
        $this->meilisearchService->indexHotels();
        $output->writeln('Hotels indexed successfully!');

        return Command::SUCCESS;
    }
} 