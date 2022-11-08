<?php

declare(strict_types=1);

namespace App\Services\Products\Factory;

use App\Services\Products\Exceptions\StrategyNotFoundException;
use App\Services\Products\Filters\CountByPriceRangeFilter;
use App\Services\Products\Filters\CountByVendorIdFilter;
use App\Services\Products\Integrations\DependencyResolverAdapterInterface;
use App\Services\Products\Interfaces\ProductFilteringStrategyInterface;

class ProductFilterStrategyFactory
{
    public function __construct(
        private DependencyResolverAdapterInterface $dependencyResolverAdapter
    ) {
    }

    public const STRATEGIES_MAPPING = [
        'count_by_price_range' => CountByPriceRangeFilter::class,
        'count_by_vendor_id' => CountByVendorIdFilter::class,
    ];

    public function build(string $strategy): ProductFilteringStrategyInterface
    {
        if (!array_key_exists($strategy, self::STRATEGIES_MAPPING)) {
            throw new StrategyNotFoundException($strategy);
        }

        return $this->dependencyResolverAdapter->resolve(self::STRATEGIES_MAPPING[$strategy]);
    }
}
