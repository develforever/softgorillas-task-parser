<?php

namespace App\Task\Parser;

class Result
{
    /**
     *
     * @var Response[]
     */
    protected $results = [];

    /**
     *
     *
     * @param Response[] $items
     * @return void
     */
    public function addResults(array $items)
    {
        $this->results = $items;
    }

    /**
     *
     * @return Response[]
     */
    public function getResults()
    {
        return $this->results;
    }



}
