<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use App\Service\twitterService;

class twitterCommand extends Command
{
    private $twitterService;

    public function __construct(twitterService $twitterService)
    {
        $this->twitterService = $twitterService;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:command-twitter')

            // the short description shown while running "php bin/console list"
            ->setDescription('Run the twitter service to gez new items.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This helps you to get connection to twitter')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $this->twitterService->crawlerCommand();

        $output->writeln([
            'User Creator',
            '============',
            $count,
        ]);
    }
}