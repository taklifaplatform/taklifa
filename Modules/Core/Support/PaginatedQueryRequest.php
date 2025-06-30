<?php

namespace Modules\Core\Support;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

/**
 * Should be used in conjunction with QueryRequest.
 *
 * @mixin \Modules\Core\Http\Requests\QueryRequest
 */
trait PaginatedQueryRequest
{
    public function getQueryPaginationParameters(): array
    {
        return [
            Parameter::query()
                ->name('page')
                ->description('Page number')
                ->schema(Schema::integer()->minimum(1)),
            Parameter::query()
                ->name('per_page')
                ->description('Number of items per page')
                ->schema(Schema::integer()->minimum(1)),

        ];
    }
}
