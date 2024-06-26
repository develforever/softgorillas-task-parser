<?php

namespace App\Task\Parser\Chain;

use App\Task\Model\Accident;
use App\Task\Model\Inspection;
use Psr\Log\LoggerInterface;

class TypeParser implements ItemParserInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function processItem($data, $originalData): array
    {
        $out = $data;
        $class = array_key_exists('class', $out) ? $out['class'] : null;

        if ($class === Accident::class) {
            $out['type'] = Accident::TYPE;
        } elseif ($class === Inspection::class) {
            $out['type'] = Inspection::TYPE;
        }

        return $out;
    }
}
