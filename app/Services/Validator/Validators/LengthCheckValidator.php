<?php

declare(strict_types=1);

namespace App\Services\Validator\Validators;

use App\Services\Validator\Interfaces\ValidatorInterface;
use InvalidArgumentException;

class LengthCheckValidator implements ValidatorInterface
{
    public function __construct(private readonly int $length)
    {
    }

    public function validate(mixed $input): bool
    {
        if (strlen($input) < $this->length) {
            throw new InvalidArgumentException(sprintf('The input must be at least %d characters!', $this->length));
        }

        return true;
    }
}
