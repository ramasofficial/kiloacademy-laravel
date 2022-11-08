<?php

namespace App\Console\Commands;

use App\Services\Products\DTO\ConsoleInputDTO;
use App\Services\Products\Model\Offer;
use App\Services\Products\ProductCountService;
use Illuminate\Console\Command;

class CountProducts extends Command
{
    protected $signature = 'products:count {strategy} {firstArgument} {secondArgument?}';

    protected $description = 'Command description';

    public function handle(ProductCountService $productCountService): int
    {
        $consoleInputDTO = new ConsoleInputDTO(
            $this->argument('strategy'),
            $this->argument('firstArgument'),
            $this->argument('secondArgument'),
        );

        $offersCollection = $productCountService->handle($consoleInputDTO);

        $this->info(sprintf('Offers count: %d', $offersCollection->count()));

        $this->newLine();
        /** @var Offer $offer */
        foreach ($offersCollection->getIterator() as $offer) {
            $this->info(
                sprintf('Offer id: %d: %s, price: %01.2f, vendor id: %d', $offer->getOfferId(), $offer->getProductTitle(), $offer->getPrice(), $offer->getVendorId())
            );
        }

        return Command::SUCCESS;
    }
}
