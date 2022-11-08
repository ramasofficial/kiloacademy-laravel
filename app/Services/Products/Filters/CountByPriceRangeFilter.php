<?php

declare(strict_types=1);

namespace App\Services\Products\Filters;

use App\Services\Products\DTO\ConsoleInputDTO;
use App\Services\Products\Interfaces\OfferCollectionInterface;
use App\Services\Products\Interfaces\ProductFilteringStrategyInterface;
use App\Services\Products\Model\Offer;

class CountByPriceRangeFilter implements ProductFilteringStrategyInterface
{
    public function filter(OfferCollectionInterface $offerCollection, ConsoleInputDTO $consoleInputDTO): OfferCollectionInterface
    {
        $priceFrom = (float) $consoleInputDTO->getFirstArgument();
        $priceTo = (float) $consoleInputDTO->getSecondArgument();

        /** @var Offer $offer */
        foreach ($offerCollection->getIterator() as $offerKey => $offer) {
            if (
                $offer->getPrice() >= $priceFrom &&
                $offer->getPrice() <= $priceTo
            ) {
                continue;
            }

            $offerCollection->remove($offerKey);
        }

        return $offerCollection;
    }
}
