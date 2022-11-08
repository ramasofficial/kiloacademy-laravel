<?php

declare(strict_types=1);

namespace App\Services\Products\Readers;

use App\Services\Products\Integrations\StorageAdapterInterface;
use App\Services\Products\Interfaces\OfferCollectionInterface;
use App\Services\Products\Interfaces\ReaderInterface;
use App\Services\Products\Transformers\OfferTransformer;
use JsonException;

class ProductsJsonReader implements ReaderInterface
{
    public function __construct(
        private string $path,
        private OfferTransformer $offerTransformer,
        private StorageAdapterInterface $storageAdapter
    ) {
    }

    /**
     * @throws JsonException
     */
    public function read(): OfferCollectionInterface
    {
        $contents = file_get_contents($this->storageAdapter->getStoragePath($this->path));

        $encodedContent = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        return $this->offerTransformer->transform($encodedContent);
    }
}
