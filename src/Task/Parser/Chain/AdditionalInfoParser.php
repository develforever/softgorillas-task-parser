<?php

namespace App\Task\Parser\Chain;

use Psr\Log\LoggerInterface;

class AdditionalInfoParser implements ItemParserInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function processItem($data, $originalData): array
    {
        $out = $data;
        $out['creationDate'] = date('Y-m-d H:i:s');
        $out['priority'] = isset($out['priority']) ? $out['priority'] : null;
        $out['notes'] = isset($out['notes']) ? $out['notes'] : null;

        return $out;
    }
}
