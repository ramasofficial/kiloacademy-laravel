<?php

namespace App\Console\Commands;

use App\Services\Products\DTO\ConsoleInputDTO;
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

        $productsCount = $productCountService->handle($consoleInputDTO)->count();

        $this->info(sprintf('Products count: %d', $productsCount));

        return Command::SUCCESS;
    }
}
