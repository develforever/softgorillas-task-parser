<?php

namespace App\Task\Parser\Chain;

use App\Task\Model\Accident;
use App\Task\Model\Inspection;
use App\Task\Model\Accident\Enum as AccidentEnum;
use App\Task\Model\Inspection\Enum as InspectionEnum;

class DescriptionParser implements ItemParserInterface
{
    public function processItem($data, $originalData): array
    {
        $out = $data;
        $description = $out['description'];

        $out['class'] = Accident::class;

        if (strpos($description, 'przegląd') !== false) {
            $out['class'] = Inspection::class;
        }

        if (strpos($description, 'bardzo pilne') !== false) {
            if ($out['class'] === Inspection::class) {
                $out['priority'] = InspectionEnum::PRIORITY_URGENT->value;
            } elseif ($out['class'] === Accident::class) {
                $out['priority'] = AccidentEnum::PRIORITY_URGENT->value;
            }
        }
        if (strpos($description, 'pilne') !== false) {
            if ($out['class'] === Inspection::class) {
                $out['priority'] = InspectionEnum::PRIORITY_HIGH->value;
            } elseif ($out['class'] === Accident::class) {
                $out['priority'] = AccidentEnum::PRIORITY_HIGH->value;
            }
        }

        return $out;
    }
}
