<?php

declare(strict_types=1);

namespace App\Services\Products\Integrations;

interface DependencyResolverAdapterInterface
{
    public function resolve(string $class): mixed;
}
