<?php

declare(strict_types=1);

namespace App\Services\Products\Filters;

use App\Services\Products\DTO\ConsoleInputDTO;
use App\Services\Products\Interfaces\OfferCollectionInterface;
use App\Services\Products\Interfaces\ProductFilteringStrategyInterface;
use App\Services\Products\Model\Offer;

class CountByVendorIdFilter implements ProductFilteringStrategyInterface
{
    public function filter(
        OfferCollectionInterface $offerCollection,
        ConsoleInputDTO $consoleInputDTO
    ): OfferCollectionInterface {
        /** @var Offer $offer */
        foreach ($offerCollection->getIterator() as $offerKey => $offer) {
            if ($offer->getVendorId() !== (int) $consoleInputDTO->getFirstArgument()) {
                $offerCollection->remove($offerKey);
            }
        }

        return $offerCollection;
    }
}
