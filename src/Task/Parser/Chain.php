<?php

namespace App\Task\Parser;

use App\Task\Parser\Chain\ItemParserInterface;
use Exception;
use Psr\Log\LoggerInterface;

class Chain implements ExecuteInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     *
     * @var ItemParserInterface[]
     */
    protected $items = [];

    public function add(ItemParserInterface $parser): self
    {


        $this->items[] = $parser;
        return $this;
    }


    public function execute(Request $request): Response
    {
        $status = Response::STATUS_OK;

        try {
            $data = $request->getData();
            for ($i = 0; $i < count($this->items); $i++) {
                $data =  $this->items[$i]->processItem($data, $request->getData());
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage(), [$e, $request]);
        }

        return new Response($data, $status, $request->getData());
    }
}
