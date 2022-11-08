<?php

declare(strict_types=1);

namespace App\Services\Products\Interfaces;

interface OfferTransformerInterface
{
    public function transform(array $data): OfferCollectionInterface;
}
