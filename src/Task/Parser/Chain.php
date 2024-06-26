<?php 

namespace App\Task\Parser;

use App\Task\Model\Unknown;
use App\Task\Parser\Chain\ItemParserInterface;

class Chain implements ExecuteInterface {

    /**
     * @property ItemParserInterface[] $items
     */
    protected $items = [];

    public function add(ItemParserInterface $parser):self{

        
        $this->items[] = $parser;
        return $this;
    }


    public function execute(Request $request):Response
    {

        $data = $request->getData();
        for($i=0; $i<count($this->items); $i++){
            $data = $this->items[$i]->processItem($data);
        }

        return new Response(new Unknown($data), Response::STATUS_OK);
    }
}