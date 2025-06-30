<?php

namespace Modules\Api\Concerns;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use InvalidArgumentException;
use Modules\Api\Contracts\Reusable;
use Modules\Api\Factories\CallbackFactory;
use Modules\Api\Factories\ParametersFactory;
use Modules\Api\Factories\RequestBodyFactory;
use Modules\Api\Factories\ResponseFactory;
use Modules\Api\Factories\SchemaFactory;
use Modules\Api\Factories\SecuritySchemeFactory;

trait Referencable
{
    public static function ref(?string $objectId = null): Schema
    {
        $instance = app(static::class);

        if (! $instance instanceof Reusable) {
            throw new InvalidArgumentException('"'.static::class.'" must implement "'.Reusable::class.'" in order to be referencable.');
        }

        $baseRef = null;

        if ($instance instanceof CallbackFactory) {
            $baseRef = '#/components/callbacks/';
        } elseif ($instance instanceof ParametersFactory) {
            $baseRef = '#/components/parameters/';
        } elseif ($instance instanceof RequestBodyFactory) {
            $baseRef = '#/components/requestBodies/';
        } elseif ($instance instanceof ResponseFactory) {
            $baseRef = '#/components/responses/';
        } elseif ($instance instanceof SchemaFactory) {
            $baseRef = '#/components/schemas/';
        } elseif ($instance instanceof SecuritySchemeFactory) {
            $baseRef = '#/components/securitySchemes/';
        }

        return Schema::ref($baseRef.$instance->build()->objectId, $objectId);
    }
}
