<?php

namespace App\Task\Parser\Chain;

use App\Task\Model\Accident;
use App\Task\Model\Inspection;
use App\Validator\DueDate;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validation;
use App\Task\Model\Accident\Enum as AccidentEnum;
use App\Task\Model\Inspection\Enum as InspectionEnum;

class DueDateParser implements ItemParserInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function processItem($data, $originalData): array
    {
        $out = $data;
        $description = $out['description'];
        $class = array_key_exists('class', $out) ? $out['class'] : null;
        $dueDate = $out['dueDate'];

        $validator = Validation::createValidator();
        $violations = $validator->validate($dueDate, [
            new DueDate()
        ]);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $this->logger->notice($violation->getMessage(), [$dueDate]);
            }
        }


        if ($class === Inspection::class) {
            $out['status'] = InspectionEnum::STATUS_NEW->value;
        } elseif ($class === Accident::class) {
            $out['status'] = AccidentEnum::STATUS_NEW->value;
        }

        if ($dueDate) {
            $parsed = strtotime($dueDate);
            if ($parsed !== false) {
                $out['dueDateParsed'] = date('Y-m-d H:i:s', $parsed);

                if ($class === Inspection::class) {
                    $out['status'] = InspectionEnum::STATUS_AUTO_SHEDULED->value;
                    $out['inspectionDate'] = date('Y-m-d', $parsed);
                    $out['weekNumber'] = +date('W', $parsed);
                } elseif ($class === Accident::class) {
                    $out['status'] = AccidentEnum::STATUS_DATE_OF_INSPECTION->value;
                    $out['serviceVisitDate'] = date('Y-m-d', $parsed);
                }
            }
        }

        return $out;
    }
}
