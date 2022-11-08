<?php

namespace App\Providers;

use App\Services\Products\Integrations\DependencyResolverAdapterInterface;
use App\Services\Products\Integrations\Laravel\LaravelDependencyResolverAdapter;
use App\Services\Products\Integrations\Laravel\LaravelStorageAdapter;
use App\Services\Products\Interfaces\OfferTransformerInterface;
use App\Services\Products\Interfaces\ReaderInterface;
use App\Services\Products\Readers\ProductsApiReader;
use App\Services\Products\Readers\ProductsJsonReader;
use App\Services\Products\Transformers\OfferTransformer;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
//        $this->app->bind(ReaderInterface::class, function () {
//            return new ProductsJsonReader(
//                'data/data.json',
//                $this->app->make(OfferTransformer::class),
//                $this->app->make(LaravelStorageAdapter::class)
//            );
//        });

//        $this->app->bind(ReaderInterface::class, function () {
//            return new ProductsApiReader(
//                'https://mocki.io/v1/ded0f481-48f3-413f-866a-37915a6edbdd',
//                $this->app->make(Client::class),
//                $this->app->make(OfferTransformer::class)
//            );
//        });

        $this->app->bind(ReaderInterface::class, function () {
            $reader = $this->app->make(ProductsApiReader::class);
            $reader->setUrl('https://mocki.io/v1/ded0f481-48f3-413f-866a-37915a6edbdd');
            return $reader;
        });

        $this->app->bind(OfferTransformerInterface::class, OfferTransformer::class);

        $this->app->bind(ClientInterface::class, Client::class);

        $this->app->bind(DependencyResolverAdapterInterface::class, LaravelDependencyResolverAdapter::class);
    }
}
