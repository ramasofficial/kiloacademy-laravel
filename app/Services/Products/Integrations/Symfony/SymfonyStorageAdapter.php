<?php

declare(strict_types=1);

namespace App\Services\Products\Integrations\Symfony;

use App\Services\Products\Integrations\StorageAdapterInterface;

class SymfonyStorageAdapter implements StorageAdapterInterface
{
    public function getStoragePath(string $path): string
    {
        throw new \RuntimeException('Implement getStoragePath() method.');
    }
}
