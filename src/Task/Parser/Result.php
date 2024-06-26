<?php

namespace App\Task\Parser;

class Result
{
    protected $results = [];
    protected $accidents;
    protected $inspections;
    protected $unknown;

    public function getAccidents(): array
    {
        return $this->accidents;
    }

    public function getInspections(): array
    {
        return $this->inspections;
    }

    public function getUnknown(): array
    {
        return $this->unknown;
    }

    public function addResultItems($items){
        $this->results = $items;

        foreach($this->results as $item){
            var_dump($item);
        }
    }
}
