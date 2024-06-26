<?php

namespace App\Task\Model;

class Inspection extends AbstractModel implements ModelInterface {
    
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';
    
    const STATUS_NEW = 'new';
    const STATUS_AUTO_SHEDULED = 'auto_sheduled';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE_OK = 'done_ok';
    const STATUS_DONE_FAILED = 'done_failed';
}