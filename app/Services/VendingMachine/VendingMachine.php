<?php

declare(strict_types=1);

namespace App\Services\VendingMachine;

class VendingMachine
{
    public function __construct(private Balance $balance)
    {
    }

    public function add(int $coin): void
    {
        $this->balance->add($coin);
    }

    public function getBalance(): int
    {
        return $this->balance->getBalance();
    }

    public function reset(): void
    {
        $this->balance->reset();
    }
}
