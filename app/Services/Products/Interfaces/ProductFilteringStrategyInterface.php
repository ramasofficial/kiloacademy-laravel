<?php

declare(strict_types=1);

namespace App\Services\Products\Interfaces;

use App\Services\Products\DTO\ConsoleInputDTO;

interface ProductFilteringStrategyInterface
{
    public function filter(OfferCollectionInterface $offerCollection, ConsoleInputDTO $consoleInputDTO): OfferCollectionInterface;
}
