<?php

namespace App\Task;

use App\Task\Parser\ChainBuilder;
use App\Task\Parser\Request;
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

        for($i=0; $i<count($inputArray); $i++){
            $chain->execute(new Request($inputArray[$i]));
        }

        return  $out;
    }
}
