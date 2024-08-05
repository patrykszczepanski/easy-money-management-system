<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Trait;

use App\Shared\Domain\Exception\FormValidationException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

trait FormValidationErrorFactoryTrait
{
    private ValidatorInterface $validator;

    public function __invoke(): void
    {
        echo 'test';
    }

    public function setValidator(ValidatorInterface $validator): self
    {
        $this->validator = $validator;

        return $this;
    }

    public function validateRequest(mixed $inputDTO): void
    {
        $validationErrors = $this->validator->validate($inputDTO);

        if ($validationErrors->count() > 0) {
            throw new FormValidationException($this->extractErrors($validationErrors));
        }
    }

    private function extractErrors(ConstraintViolationListInterface $violations): array
    {
        $errorsArray = [];
        foreach ($violations as $constraint => $violationList) {
            $errorsArray[$violationList->getPropertyPath()][] = $violationList->getMessage();
        }

        return $errorsArray;
    }
}
