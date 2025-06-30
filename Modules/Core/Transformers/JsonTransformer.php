<?php

namespace Modules\Core\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonTransformer extends JsonResource
{
    public function schema(): Schema
    {
        return Schema::object(class_basename($this));
    }

    public function buildDocs(
        ?int $statusCode = null,
        ?string $description = null,
        bool $isArray = false,
        bool $isPagination = false,
    ): Response {
        $dataSchema = Schema::object($this->wrap ?? 'data')->properties(
            Schema::ref('#/components/schemas/'.class_basename($this), 'data')
        );
        if ($isPagination) {
            return Response::ok(class_basename($this).'PaginatedTransformer')
                ->description($description)
                ->statusCode($statusCode)
                ->content(
                    MediaType::json()->schema(
                        Schema::object()->properties(
                            Schema::array($this->wrap ?? 'data')->items(
                                Schema::ref('#/components/schemas/'.class_basename($this))
                            )->required(),

                            Schema::object('links')->properties(
                                Schema::string('first')->required()->example(url('api/users?page=1')),
                                Schema::string('last')->required()->example(url('api/users?page=1')),
                                Schema::string('prev'),
                                Schema::string('next'),
                            )->required(),

                            Schema::object('meta')->properties(
                                Schema::integer('current_page')->required(),
                                Schema::integer('from')->required(),
                                Schema::integer('last_page')->required(),
                                Schema::array('links')->items(
                                    Schema::object()->properties(
                                        Schema::string('url')->example(url('api/users?page=1')),
                                        Schema::string('label'),
                                        Schema::boolean('active'),
                                    )
                                ),
                                Schema::string('path')->required(),
                                Schema::integer('per_page')->required(),
                                Schema::integer('to')->required(),
                                Schema::integer('total')->required(),
                            )->required()
                        )
                    )
                );
        }

        if ($isArray) {
            return Response::ok(class_basename($this).'CollectionTransformer')
                ->description($description)
                ->statusCode($statusCode)
                ->content(
                    MediaType::json()->schema(
                        Schema::object($this->wrap ?? 'data')->properties(
                            Schema::array('data')->items(
                                Schema::ref('#/components/schemas/'.class_basename($this))
                            ),
                        )
                    )
                );
        }

        return Response::ok(class_basename($this).'Transformer')
            ->description($description)
            ->statusCode($statusCode)
            ->content(
                MediaType::json()->schema(
                    $dataSchema,
                )
            );
    }
}
