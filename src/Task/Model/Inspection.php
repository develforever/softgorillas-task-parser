<?php

namespace App\Task\Model;

class Inspection extends AbstractModel implements ModelInterface
{
    public const PRIORITY_NORMAL = 'normal';
    public const PRIORITY_HIGH = 'high';
    public const PRIORITY_URGENT = 'urgent';

    public const STATUS_NEW = 'new';
    public const STATUS_AUTO_SHEDULED = 'auto_sheduled';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_DONE_OK = 'done_ok';
    public const STATUS_DONE_FAILED = 'done_failed';

    public const TYPE = 'inspection';

    public $inspectionDate;
    public $weekNumber;
}
