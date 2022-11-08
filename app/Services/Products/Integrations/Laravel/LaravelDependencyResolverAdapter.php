<?php

declare(strict_types=1);

namespace App\Services\Products\Integrations\Laravel;

use App\Services\Products\Integrations\DependencyResolverAdapterInterface;
use Illuminate\Foundation\Application;

class LaravelDependencyResolverAdapter implements DependencyResolverAdapterInterface
{
    public function __construct(private Application $application)
    {
    }

    public function resolve(string $class): mixed
    {
        return $this->application->make($class);
    }
}
