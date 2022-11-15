<?php

declare(strict_types=1);

namespace App\Services\VendingMachine\Exceptions;

use InvalidArgumentException;
use Throwable;

class CoinIsNotSupportedException extends InvalidArgumentException
{
    private const ERROR_MESSAGE = 'Coin: %d is not supported exception!';

    public function __construct(int $coin, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $coin), $code, $previous);
    }
}
