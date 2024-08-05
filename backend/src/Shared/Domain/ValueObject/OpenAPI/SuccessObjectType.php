<?php

namespace App\Shared\Domain\ValueObject\OpenAPI;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations\MediaType;
use OpenApi\Attributes\Schema;
use OpenApi\Generator;

class SuccessObjectType extends MediaType
{
    public function __construct(
        string $modelClassname
    ) {
        parent::__construct([
            'mediaType' => 'application/json',
            'example' => Generator::UNDEFINED,
            'encoding' => Generator::UNDEFINED,
            'x' => Generator::UNDEFINED,
            'value' => $this->combine(
                new Schema(
                    ref: new Model(
                        type: $modelClassname
                    )
                ),
                null,
                null
            ),
        ]);
    }
}
