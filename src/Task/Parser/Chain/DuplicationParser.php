<?php

namespace App\Task\Parser\Chain;

class DuplicationParser implements ItemParserInterface
{
    protected $descriptionHashes = [];

    public function processItem($data, $originalData): array|bool
    {
        $out = $data;
        $description = $out['description'];
        $hash = md5($description);

        if (in_array($hash, $this->descriptionHashes)) {
            $out = $originalData;
            $out['duplicate'] = true;

        }

        $this->descriptionHashes[] = $hash;

        return $out;
    }
}
