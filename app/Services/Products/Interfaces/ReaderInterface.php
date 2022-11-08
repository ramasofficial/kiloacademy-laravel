<?php

declare(strict_types=1);

namespace App\Services\Products\Interfaces;

interface ReaderInterface
{
    public function read(): OfferCollectionInterface;


}
