<?php

namespace App\Task\Parser\Chain;

use App\Task\Model\Accident;
use App\Task\Model\Inspection;
use Psr\Log\LoggerInterface;
use App\Task\Model\Accident\Enum as AccidentEnum;
use App\Task\Model\Inspection\Enum as InspectionEnum;

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
            $out['type'] = AccidentEnum::TYPE->value;
        } elseif ($class === Inspection::class) {
            $out['type'] = InspectionEnum::TYPE->value;
        }

        return $out;
    }
}
