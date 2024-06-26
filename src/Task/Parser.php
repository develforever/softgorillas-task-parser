<?php

namespace App\Task;

use App\Task\Parser\ChainBuilder;
use App\Task\Parser\Request;
use App\Task\Parser\Response;
use App\Task\Parser\Result;
use Psr\Log\LoggerInterface;

class Parser
{

    public function __construct(private LoggerInterface $logger, private ChainBuilder $builder)
    {
    }

    public function parse(array $inputArray): Result
    {
        $out = new Result;

        $chain = $this->builder->build();

        /**
         * @var Response[]
         */
        $responses = [];

        for($i=0; $i<count($inputArray); $i++){
            $responses[] = $chain->execute(new Request($inputArray[$i]));
        }

        $out->addResultItems($responses);

        return  $out;
    }
}
