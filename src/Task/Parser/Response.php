<?php

namespace App\Task\Parser;

use App\Task\Model\ModelInterface;

class Response
{

    const STATUS_OK = 'ok';
    const STATUS_FAILED = 'FAILED';

    protected ModelInterface $data;
    protected $status;

    public function __construct(ModelInterface $data, string $status)
    {
        $this->data = $data;
        $this->status = $status;
    }

    public function getData(): ModelInterface
    {
        return $this->data;
    }
}
