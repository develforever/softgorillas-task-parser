<?php

namespace App\Task\Model\Accident;

enum Enum: string
{
    case PRIORITY_NORMAL = 'normal';
    case PRIORITY_HIGH = 'high';
    case PRIORITY_URGENT = 'urgent';

    case STATUS_NEW = 'new';
    case STATUS_DATE_OF_INSPECTION = 'date_of_inspection';
    case STATUS_IN_PROGRESS = 'in_progress';
    case STATUS_DONE_OK = 'done_ok';
    case STATUS_DONE_FAILED = 'done_failed';

    case TYPE = 'accident';
}
