<?php

declare(strict_types=1);

namespace exceptions;

final class ValidationException extends \Exception
{
    public function __construct(array $errors) {
        parent::__construct($this->getContext($errors), 422);
    }

    public function getContext(array $errors): string
    {
        return json_encode(['errors' => $errors]);
    }
}
