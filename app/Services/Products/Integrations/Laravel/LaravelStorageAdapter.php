<?php

declare(strict_types=1);

namespace App\Services\Products\Integrations\Laravel;

use App\Services\Products\Integrations\StorageAdapterInterface;

class LaravelStorageAdapter implements StorageAdapterInterface
{
    public function getStoragePath(string $path): string
    {
        return storage_path($path);
    }
}
