<?php

namespace App\Shared\Domain\Error;

enum EnumErrorAssert: string
{
    case NOT_BLANK = 'assert.not_blank';
    case INVALID_VALUE = 'assert.invalid_value';
    case INVALID_EMAIL = 'assert.invalid_email';
    case INVALID_DATE = 'assert.invalid_date';
    case INVALID_MIN_VALUE = 'assert.invalid_minimum_value';
    case INVALID_MAX_VALUE = 'assert.invalid_maximum_value';
    case INVALID_MAX_LENGTH = 'assert.invalid_max_length';
    case INVALID_MIN_LENGTH = 'assert.invalid_min_length';
    case INVALID_EXACT_LENGTH = 'assert.invalid_exact_length';
    case CONSTRAINT_TYPE_MISMATCH = 'validation.internal.constraint_type_mismatch';
    case INVALID_UUID = 'assert.invalid_uuid';
    case INVALID_MIME_TYPE = 'assert.invalid_mime_type';
    case INVALID_ATTACHMENT = 'assert.invalid_attachment';
    case INVALID_INSTALLMENT = 'assert.invalid_installment';
    case INVALID_INSTALLMENT_PRICE = 'assert.invalid_installment_price';
    case INVALID_INSTALLMENT_COUNT = 'assert.invalid_installment_count';
    case MISSING_VERSION_PARAM = 'assert.missing_version_parameter';
}
