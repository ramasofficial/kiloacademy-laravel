<?php

declare(strict_types=1);

namespace Tests\Unit\Products;

use App\Services\Products\Exceptions\StrategyNotFoundException;
use App\Services\Products\Factory\ProductFilterStrategyFactory;
use App\Services\Products\Filters\CountByPriceRangeFilter;
use App\Services\Products\Filters\CountByVendorIdFilter;
use App\Services\Products\Integrations\Laravel\LaravelDependencyResolverAdapter;
use Generator;
use Tests\TestCase;

class ProductFilterStrategyFactoryTest extends TestCase
{
    private ProductFilterStrategyFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new ProductFilterStrategyFactory(
            $this->app->make(LaravelDependencyResolverAdapter::class)
        );
    }

    /**
     * @dataProvider strategyDataProvider
     */
    public function testCanBuildStrategyCorrect(string $strategy, string $expectedClass, ?string $exception): void
    {
        if ($exception) {
            $this->expectException($exception);
        }

        $actual = $this->factory->build($strategy);

        $this->assertInstanceOf($expectedClass, $actual);
    }

    public function strategyDataProvider(): Generator
    {
        yield 'First example with count_by_price_range strategy' => [
            'strategy' => 'count_by_price_range',
            'expected_class' => CountByPriceRangeFilter::class,
            'exception' => null,
        ];

        yield 'Second example with count_by_price_range strategy' => [
            'strategy' => 'count_by_vendor_id',
            'expected_class' => CountByVendorIdFilter::class,
            'exception' => null,
        ];

        yield 'Third example with test strategy, throws exception' => [
            'strategy' => 'test',
            'expected_class' => '',
            'exception' => StrategyNotFoundException::class,
        ];
    }
}
