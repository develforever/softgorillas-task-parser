<?php

namespace App\Task\Model;

class Accident extends AbstractModel implements ModelInterface {
    
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    const STATUS_NEW = 'new';
    const STATUS_DATE_OF_INSPECTION = 'date_of_inspection';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE_OK = 'done_ok';
    const STATUS_DONE_FAILED = 'done_failed';
}