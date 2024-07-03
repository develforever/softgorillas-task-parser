<?php

namespace App\Task\Model\Inspection;

enum Enum: string
{
    case PRIORITY_NORMAL = 'normal';
    case PRIORITY_HIGH = 'high';
    case PRIORITY_URGENT = 'urgent';

    case STATUS_NEW = 'new';
    case STATUS_AUTO_SHEDULED = 'auto_sheduled';
    case STATUS_IN_PROGRESS = 'in_progress';
    case STATUS_DONE_OK = 'done_ok';
    case STATUS_DONE_FAILED = 'done_failed';

    case TYPE = 'inspection';
}
