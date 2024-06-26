<?php

namespace App\Task\Parser\Chain;

interface ItemParserInterface {
    

    public function processItem($data);
}