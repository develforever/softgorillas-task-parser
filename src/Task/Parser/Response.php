<?php

namespace App\Task\Parser;

class Response
{
    public const STATUS_OK = 'ok';
    public const STATUS_FAILED = 'failed';
    public const STATUS_UNKNOWN = 'unknown';

    protected array $data;
    protected $status;
    protected $originalData;

    public function __construct(array $data, string $status, array $originalData)
    {
        $this->data = $data;
        $this->status = $status;
        $this->originalData = $originalData;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getoriginalData(): array
    {
        return $this->originalData;
    }
}
