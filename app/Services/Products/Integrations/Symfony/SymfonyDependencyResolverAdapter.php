<?php

declare(strict_types=1);

namespace App\Services\Products\Integrations\Symfony;

use App\Services\Products\Integrations\DependencyResolverAdapterInterface;

class SymfonyDependencyResolverAdapter implements DependencyResolverAdapterInterface
{
    public function resolve(string $class): mixed
    {
        throw new \RuntimeException('Implement resolve() method.');
    }
}
