<?php

namespace App\Task\Parser;

use App\Task\Parser\Chain\DescriptionParser;
use App\Task\Parser\Chain\DueDateParser;
use Psr\Log\LoggerInterface;

class ChainBuilder
{


    public function __construct(private LoggerInterface $logger, private DescriptionParser $descriptionParser, private DueDateParser $dueDateParser)
    {
    }

    public function build(): Chain
    {
        $out = new Chain();
        return  $out
        ->add($this->descriptionParser)
        ->add($this->dueDateParser);
    }
}
