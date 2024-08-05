<?php

declare(strict_types=1);

namespace App\Shared\Domain\Error;

enum EnumErrorApi: string
{
    case ERROR_INVALID_TOKEN = 'api.resend_invalid_token';
    case ERROR_AUTH_GRANT = 'api.error.auth_grant';
    case ERROR_INVALID_CODE = 'api.error.invalid_code';
    case ERROR_USER_EXISTS = 'api.error.user_exists';
    case ERROR_USER_SELF_DELETE = 'api.error.user_self_delete';
}
