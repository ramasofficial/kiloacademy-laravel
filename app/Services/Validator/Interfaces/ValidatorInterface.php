<?php

declare(strict_types=1);

namespace App\Services\Validator\Interfaces;

interface ValidatorInterface
{
    public function validate(mixed $input): bool;
}
