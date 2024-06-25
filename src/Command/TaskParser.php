<?php

namespace App\Command;

use App\Task\Parser;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class TaskParser extends Command
{
    private $projectDir;

    public function __construct($projectDir, private LoggerInterface $logger, private Parser $parser)
    {
        $this->projectDir = $projectDir;
        parent::__construct();
    }

    protected function configure(): void
    {

        $this
            ->setName('app:task-parser')
            ->setDescription('This command runs task parser')
            ->setHelp('Help ...')
            ->addArgument('file-name', InputArgument::REQUIRED, 'File placed in `data` directory named <file-name>.json');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $input->getArgument('file-name'));
        $path = $this->projectDir;
        $source = $path . '/data/' . $fileName . '.json';

        if (!is_file($source)) {
            $output->writeln('File not exists');
            return Command::FAILURE;
        }

        $sourceContent = file_get_contents($source);

        if(!json_validate($sourceContent)){
            $output->writeln('JSON validation failed');
            return Command::FAILURE;
        }

        $sourceJSON = json_decode($sourceContent, true);

        
        $parsedItems = $this->parser->parse($sourceJSON);

        $output->writeln('Pass the parameter ' . $input->getArgument('file-name'));
        return Command::FAILURE;
    }
}
