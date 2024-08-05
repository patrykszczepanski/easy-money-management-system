<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Error\EnumErrorHttp;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class FormValidationException extends Exception
{
    private array $errorMessages = [];

    public function __construct(array $errorMessages = [], ?Throwable $previous = null)
    {
        parent::__construct(EnumErrorHttp::FORM_VALIDATION_ERROR->value, Response::HTTP_BAD_REQUEST, $previous);
        $this->errorMessages = $errorMessages;
    }

    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }
}
