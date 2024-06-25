<?php 

namespace App\Task\Parser;

use App\Task\Model\Unknown;
use App\Task\Parser\Chain\ItemParserInterface;

class Chain implements ExecuteInterface {

    protected $items = [];

    public function add(ItemParserInterface $parser):self{

        $this->items[] = $parser;
        return $this;
    }


    public function execute(Request $request):Response
    {
        return new Response(new Unknown, Response::STATUS_OK);
    }
}