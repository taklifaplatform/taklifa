<?php

namespace Modules\Core\Http\Requests;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class FormDataRequest extends FormRequest
{
    public function buildDocs(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::formUrlEncoded()->schema(
                    Schema::ref('#/components/schemas/'.class_basename($this))
                )
            )
            ->required(true);
    }
}
