<?php

declare(strict_types=1);

namespace App\Services\Validator\Validators;

use App\Services\Validator\Interfaces\ValidatorInterface;
use InvalidArgumentException;

class SymbolValidator implements ValidatorInterface
{
    public function __construct(private readonly string $symbol)
    {
    }

    public function validate(mixed $input): bool
    {
        if (!str_contains($input, $this->symbol)) {
            throw new InvalidArgumentException(sprintf('The input must have at least 1 [%s] symbol!', $this->symbol));
        }

        return true;
    }
}
