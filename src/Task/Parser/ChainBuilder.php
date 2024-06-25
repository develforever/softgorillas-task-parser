<?php

namespace App\Task\Parser;

use App\Task\Parser\Chain\DescriptionParser;
use Psr\Log\LoggerInterface;

class ChainBuilder
{


    public function __construct(private LoggerInterface $logger)
    {
    }

    public static function build(): Chain
    {
        $out = new Chain();
        return  $out->add(new DescriptionParser());
    }
}
