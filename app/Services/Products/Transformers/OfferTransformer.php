<?php

declare(strict_types=1);

namespace App\Services\Products\Transformers;

use App\Services\Products\Collections\OfferCollection;
use App\Services\Products\Interfaces\OfferCollectionInterface;
use App\Services\Products\Interfaces\OfferTransformerInterface;
use App\Services\Products\Model\Offer;

class OfferTransformer implements OfferTransformerInterface
{
    public function transform(array $data): OfferCollectionInterface
    {
        $collection = new OfferCollection();

        foreach ($data as $product) {
            $collection->add(
                new Offer(
                    $product['offerId'],
                    $product['productTitle'],
                    $product['vendorId'],
                    $product['price'],
                )
            );
        }

        return $collection;
    }
}
