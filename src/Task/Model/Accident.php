<?php

namespace App\Task\Model;

class Accident extends AbstractModel implements ModelInterface
{
    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';
    public const PRIORITY_URGENT = 'urgent';

    public const STATUS_NEW = 'new';
    public const STATUS_DATE_OF_INSPECTION = 'date_of_inspection';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_DONE_OK = 'done_ok';
    public const STATUS_DONE_FAILED = 'done_failed';

    public const TYPE = 'accident';

    public $serviceVisitDate;
}
