<?php

namespace App\Restaurant\Presentation\CLI;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends Command
{
    public static $defaultName = 'app:parser';
    private ParserHandler $parserManager;
    private EntityManagerInterface $em;

    public function __construct(ParserHandler $parserManager, EntityManagerInterface $em)
    {
        $this->parserManager = $parserManager;
        $this->em = $em;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output) : int
    {
        $this->em->transactional(function () {
            $this->parserManager->parse();
        });

        return Command::SUCCESS;
    }
}