<?php

namespace Modules\Api\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Response
{
    public $factory;

    public ?int $statusCode;

    public ?string $description;

    public function __construct(
        $factory,
        int $statusCode = 200,
        string $description = 'Successful response',
        bool $isArray = false,
        bool $isPagination = false,
    ) {
        // check if $factory is instance of FormRequest
        if (is_subclass_of($factory, \Modules\Core\Http\Requests\FormRequest::class)) {
            $factory = (new $factory([]))->buildValidationErrorsDocs();
            $this->factory = $factory;
        } else {
            $this->factory = (new $factory(null))->buildDocs(
                statusCode: $statusCode,
                description: $description,
                isArray: $isArray,
                isPagination: $isPagination,
            );
        }

        $this->statusCode = $statusCode;
        $this->description = $description;
    }
}
