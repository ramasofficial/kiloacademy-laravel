<?php

declare(strict_types=1);

namespace App\Services\Validator;

use App\Services\Validator\Interfaces\ValidatorInterface;
use Exception;
use LogicException;

class ValidatorService
{
    /**
     * @param ValidatorInterface[] $validators
     */
    public function __construct(private readonly array $validators)
    {
        $this->checkValidatorInstances();
    }

    public function validate(mixed $input): array
    {
        $errors = [];
        foreach ($this->validators as $validator) {
            try {
                $validator->validate($input);
            } catch (Exception $exception) {
                $errors[][$validator::class] = $exception->getMessage();
            }
        }

        return $errors;
    }

    private function checkValidatorInstances(): void
    {
        foreach ($this->validators as $validator) {
            if (!$validator instanceof ValidatorInterface) {
                throw new LogicException(sprintf('Passed not a Validator instance: %s', $validator::class));
            }
        }
    }
}
