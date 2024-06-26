<?php

namespace App\Command;

use App\Task\Model\Accident;
use App\Task\Model\Inspection;
use App\Task\Parser;
use App\Task\Parser\InstanceFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class TaskParser extends Command
{
    private $projectDir;

    public function __construct($projectDir, private LoggerInterface $logger, private Parser $parser, private InstanceFactory $instanceFactory)
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

        $output->writeln('Starting pprocess at '.date('Y-m-d H:i:s'));

        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $input->getArgument('file-name'));
        $path = $this->projectDir;
        $source = $path . '/data/' . $fileName . '.json';

        if (!is_file($source)) {
            $output->writeln('File not exists');
            return Command::FAILURE;
        }

        $sourceContent = file_get_contents($source);

        if(!json_validate($sourceContent)) {
            $output->writeln('JSON validation failed');
            return Command::FAILURE;
        }

        $output->writeln('Pprocessing ... '.$source);

        $sourceJSON = json_decode($sourceContent, true);
        $parsedItems = $this->parser->parse($sourceJSON);

        $models =  $this->instanceFactory->makeInstances($parsedItems);

        $accidents = $this->instanceFactory->getByType(Accident::TYPE, $models);
        $inspections = $this->instanceFactory->getByType(Inspection::TYPE, $models);
        $duplications = $this->instanceFactory->getByField('duplicate', true, $parsedItems->getResults());

        $dest = $path . '/data/'.$input->getArgument('file-name').'-accidents.json';
        file_put_contents($dest, json_encode($accidents, JSON_PRETTY_PRINT));
        $dest = $path . '/data/'.$input->getArgument('file-name').'-inspections.json';
        file_put_contents($dest, json_encode($inspections, JSON_PRETTY_PRINT));
        $dest = $path . '/data/'.$input->getArgument('file-name').'-duplications.json';
        file_put_contents($dest, json_encode(array_map(function ($e) {
            unset($e['duplicate']);
            return $e;
        }, $duplications), JSON_PRETTY_PRINT));


        $output->writeln('Items to process: '.count($sourceJSON));
        $output->writeln('Processed: '.count($parsedItems->getResults()));
        $output->writeln('Accidents: '.count($accidents));
        $output->writeln('Inspections: '.count($inspections));
        $output->writeln('Duplications: '.count($duplications));

        foreach($duplications as $item) {
            $output->writeln(" Number:".''.$item['number']);
        }

        return Command::SUCCESS;
    }
}
