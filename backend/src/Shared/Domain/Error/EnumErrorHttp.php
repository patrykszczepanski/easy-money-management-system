<?php

namespace App\Shared\Domain\Error;

enum EnumErrorHttp: string
{
    /* Global messages */
    case NOT_FOUND = 'http.not_found';
    case NOT_ACCEPTABLE = 'http.invalid_request';
    case UNEXPECTED_ERROR = 'http.unexpected_error';
    case INTERNAL_ERROR = 'http.internal_error';

    /* Authorization and authentication */
    case INVALID_JSON_FORMAT = 'http.invalid_json_format';
    case AUTHORIZATION_REQUIRED = 'http.authorization_required';
    case AUTHORIZATION_INVALID = 'http.authorization_invalid';
    case TOKEN_EXPIRED = 'http.token_expired';
    case TOKEN_INVALID = 'http.token_invalid';
    case ACCESS_DENIED = 'http.access_denied';

    /* Form validation */
    case FORM_VALIDATION_ERROR = 'http.form_validation_error';
    case FORM_EXTRA_FIELDS_ERROR = 'http.form_extra_fields_error';
}
