<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;
use JsonException;

class TestController extends Controller
{
    /**
     * @throws JsonException
     */
    #[NoReturn] public function __invoke(): void
    {
        $contents = file_get_contents(storage_path('data/data.json'));

        $encodedContent = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        dd($encodedContent);
    }
}
