<?php

namespace App\Task\Parser;

class Request {

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}