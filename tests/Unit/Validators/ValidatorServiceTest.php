<?php

declare(strict_types=1);

namespace Tests\Unit\Validators;

use App\Services\Validator\Validators\LengthCheckValidator;
use App\Services\Validator\Validators\LowercaseValidator;
use App\Services\Validator\Validators\SymbolValidator;
use App\Services\Validator\ValidatorService;
use Tests\TestCase;

class ValidatorServiceTest extends TestCase
{
    // TODO: write tests
    public function testService(): void
    {
        new ValidatorService([
            new LengthCheckValidator(5),
            new LowercaseValidator(),
            new SymbolValidator('!')
        ]);

        $this->assertTrue(true);
    }
}
