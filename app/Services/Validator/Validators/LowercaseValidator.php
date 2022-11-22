<?php

declare(strict_types=1);

namespace App\Services\Validator\Validators;

use App\Services\Validator\Interfaces\ValidatorInterface;
use InvalidArgumentException;

class LowercaseValidator implements ValidatorInterface
{
    public function validate(mixed $input): bool
    {
        if ($input !== strtolower($input)) {
            throw new InvalidArgumentException('The input must contains only lowercase characters!');
        }

        return true;
    }
}
