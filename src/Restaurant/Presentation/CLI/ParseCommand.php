<?php

namespace App\Restaurant\Presentation\CLI;

use App\Restaurant\Application\Importer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends Command
{
    public static $defaultName = 'app:parser';
    private Importer $parserManager;
    private EntityManagerInterface $em;

    public function __construct(Importer $parserManager, EntityManagerInterface $em)
    {
        $this->parserManager = $parserManager;
        $this->em = $em;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output) : int
    {
        $this->em->transactional(function () {
            $this->parserManager->import();
        });

        return Command::SUCCESS;
    }
}
