<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class DueDate extends Constraint
{
    public string $message = 'The string "{{ string }}" contains not valid date time string';

    // all configurable options must be passed to the constructor
    public function __construct(?string $mode = null, ?string $message = null, ?array $groups = null, $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->message = $message ?? $this->message;
    }
}