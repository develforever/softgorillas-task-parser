<?php

namespace App\Task\Parser;

use App\Task\Model\AbstractModel;
use App\Task\Model\Accident;
use App\Task\Model\Inspection;
use App\Task\Model\ModelInterface;
use Exception;
use Psr\Log\LoggerInterface;
use App\Task\Model\Accident\Enum as AccidentEnum;
use App\Task\Model\Inspection\Enum as InspectionEnum;

class InstanceFactory
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     *
     * @param Result $data
     * @return ModelInterface[]
     */
    public function makeInstances(Result $result): array
    {
        $out = [];
        $data = $result->getResults();

        $responseData = null;
        try {
            foreach ($data as $resposne) {
                $responseData = $resposne->getData();
                $inst = null;
                $class = isset($responseData['class']) ? $responseData['class'] : null;
                if ($class === Accident::class) {
                    $inst = new Accident();
                } elseif ($class === Inspection::class) {
                    $inst = new Inspection();
                }

                if ($inst) {
                    foreach (get_class_vars(get_class($inst)) as $f => $fvalue) {

                        $inst->{$f} = isset($responseData[$f]) ? $responseData[$f] : null;

                    }

                    $out[] = $inst;
                }
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage(), [$e, $responseData]);
        }

        return $out;
    }

    /**
     *
     * @param AccidentEnum::TYPE|InspectionEnum::TYPE $type
     * @param AbstractModel[] $models
     * @return AbstractModel[]
     */
    public function getByType(string $type, array $models): array
    {
        $out = [];
        foreach ($models as $model) {
            if ($model->type === $type) {
                $out[] = $model;
            }
        }
        return $out;
    }

    /**
     *
     * @param string $field
     * @param array $models
     * @return array
     */
    public function getByField(string $field, $value, array $models): array
    {
        $out = [];
        foreach ($models as $item) {
            $tmp = $item;
            $itemValue = null;
            if (is_array($item)) {
                $itemValue = isset($item[$field]) ? $item[$field] : null;
            } elseif ($item instanceof Response) {

                $responseData = $item->getData();
                $itemValue = isset($responseData[$field]) ? $responseData[$field] : null;
                $tmp = $responseData;
            } elseif ($item instanceof AbstractModel) {
                $itemValue = $item->{$field};
            }
            if ($itemValue === $value) {
                $out[] = $tmp;
            }
        }
        return $out;
    }
}
