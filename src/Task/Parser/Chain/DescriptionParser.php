<?php

namespace App\Task\Parser\Chain;

use App\Task\Model\Accident;
use App\Task\Model\Inspection;

class DescriptionParser implements ItemParserInterface
{

    protected $descriptionHashes = [];

    public function processItem($data): array
    {
        $out = $data;
        $description = $out['description'];
        $hash = md5($description);

        if (in_array($hash, $this->descriptionHashes)) {
            $out['duplicate_description'] = true;
            return $out;
        }

        $out['class'] = Accident::class;

        if (strpos($description, 'przegląd') !== false) {
            $out['class'] = Inspection::class;
        }

        if (strpos($description, 'bardzo pilne') !== false) {
            if ($out['class'] === Inspection::class) {
                $out['priority'] = Inspection::PRIORITY_URGENT;
            } elseif ($out['class'] === Accident::class) {
                $out['priority'] = Accident::PRIORITY_URGENT;
            }
        }
        if (strpos($description, 'pilne') !== false) {
            if ($out['class'] === Inspection::class) {
                $out['priority'] = Inspection::PRIORITY_HIGH;
            } elseif ($out['class'] === Accident::class) {
                $out['priority'] = Accident::PRIORITY_HIGH;
            }
        }

        $this->descriptionHashes[] = $hash;

        return $out;
    }
}
