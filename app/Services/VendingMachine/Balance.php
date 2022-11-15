<?php

declare(strict_types=1);

namespace App\Services\VendingMachine;

use App\Services\VendingMachine\Exceptions\CoinIsNotSupportedException;

class Balance
{
    private const ACCEPTABLE_COINS = [
        5,
        10,
        15,
    ];

    private int $balance = 0;

    public function add(int $coin): void
    {
        if (!in_array($coin, self::ACCEPTABLE_COINS)) {
            throw new CoinIsNotSupportedException($coin);
        }

        $this->balance += $coin;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function reset(): void
    {
        $this->balance = 0;
    }
}
