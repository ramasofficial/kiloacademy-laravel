<?php

declare(strict_types=1);

namespace App\Services\Products\Integrations;

interface StorageAdapterInterface
{
    public function getStoragePath(string $path): string;
}
