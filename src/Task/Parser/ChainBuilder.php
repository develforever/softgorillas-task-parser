<?php

namespace App\Task\Parser;

use App\Task\Parser\Chain\AdditionalInfoParser;
use App\Task\Parser\Chain\DescriptionParser;
use App\Task\Parser\Chain\DueDateParser;
use App\Task\Parser\Chain\DuplicationParser;
use App\Task\Parser\Chain\MakeInstance;
use App\Task\Parser\Chain\TypeParser;
use Psr\Log\LoggerInterface;

class ChainBuilder
{
    public function __construct(private LoggerInterface $logger, private DescriptionParser $descriptionParser, private DueDateParser $dueDateParser, private TypeParser $typeParser, private AdditionalInfoParser $additionalInfoParser, private DuplicationParser $duplicationParser, private Chain $chain)
    {
    }

    public function build(): Chain
    {
        return  $this->chain
            ->add($this->descriptionParser)
            ->add($this->dueDateParser)
            ->add($this->typeParser)
            ->add($this->additionalInfoParser)
            ->add($this->duplicationParser);
    }
}
