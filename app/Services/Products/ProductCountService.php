<?php

declare(strict_types=1);

namespace App\Services\Products;

use App\Services\Products\DTO\ConsoleInputDTO;
use App\Services\Products\Factory\ProductFilterStrategyFactory;
use App\Services\Products\Interfaces\OfferCollectionInterface;
use App\Services\Products\Interfaces\ReaderInterface;
use Illuminate\Support\Collection;

class ProductCountService
{
    public function __construct(
        private ReaderInterface $reader,
        private ProductFilterStrategyFactory $productFilterStrategyFactory
    ) {
    }

    public function handle(ConsoleInputDTO $consoleInputDTO): OfferCollectionInterface
    {
        $productsCollection = $this->reader->read();

        return $this->productFilterStrategyFactory
            ->build($consoleInputDTO->getStrategy())
            ->filter($productsCollection, $consoleInputDTO);
    }
}
