<?php

namespace App\Task\Parser\Chain;

use App\Task\Model\Accident;
use App\Task\Model\Inspection;
use App\Validator\DueDate;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Time;
use Symfony\Component\Validator\Validation;

class DueDateParser implements ItemParserInterface
{

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function processItem($data): array
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
            $out['status'] = Inspection::STATUS_NEW;
        } elseif ($class === Accident::class) {
            $out['status'] = Accident::STATUS_NEW;
        }

        if ($dueDate) {
            $parsed = strtotime($dueDate);
            if ($parsed !== false) {
                $out['dueDateParsed'] = date('Y-m-d H:i:s', $parsed);

                if ($class === Inspection::class) {
                    $out['status'] = Inspection::STATUS_AUTO_SHEDULED;
                } elseif ($class === Accident::class) {
                    $out['status'] = Accident::STATUS_DATE_OF_INSPECTION;
                }
            }
        }

        return $out;
    }
}
