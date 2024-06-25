<?php

namespace App\Task\Parser;

class Result
{

    protected $accidents;
    protected $inspections;

    public function setAccidents(array $list)
    {
        $this->accidents = $list;
    }

    public function setInspections(array $list)
    {
        $this->inspections = $list;
    }

    public function getAccidents(): array
    {
        return $this->accidents;
    }

    public function getInspections(): array
    {
        return $this->inspections;
    }
}
