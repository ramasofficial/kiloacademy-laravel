<?php

declare(strict_types=1);

namespace App\Services\Products\DTO;

class ConsoleInputDTO
{
    public function __construct(
        private string $strategy,
        private mixed $firstArgument,
        private mixed $secondArgument = null
    ) {
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    public function getFirstArgument(): mixed
    {
        return $this->firstArgument;
    }

    public function getSecondArgument(): mixed
    {
        return $this->secondArgument;
    }
}
