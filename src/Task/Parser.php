<?php

namespace App\Task;

use Psr\Log\LoggerInterface;

class Parser
{

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function parse(array $inputArray): array
    {
        $out = [];

        for($i=0; $i<count($inputArray); $i++){
            
        }

        return  $out;
    }
}
