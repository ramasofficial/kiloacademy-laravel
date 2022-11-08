<?php

declare(strict_types=1);

namespace App\Services\Products\Exceptions;

use LogicException;
use Throwable;

class StrategyNotFoundException extends LogicException
{
    public const ERROR_MESSAGE = 'Strategy %s does not exist!';

    public function __construct(private string $strategy, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf(self::ERROR_MESSAGE, $this->strategy),
            $code,
            $previous
        );
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }
}
