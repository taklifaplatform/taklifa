<?php

namespace Modules\Core\Http\Requests;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class QueryRequest extends FormRequest
{
    public function getQueryParametersFromRules()
    {
        $properties = [];
        if (method_exists($this, 'getQueryPaginationParameters')) {
            $properties = $this->getQueryPaginationParameters();
        }

        foreach ($this->rules() as $key => $rules) {
            // TODO: handle when number or array or object
            $prop = Parameter::query()
                ->name($key);
            $rules = is_string($rules) ? explode('|', $rules) : $rules;
            foreach ($rules as $rule) {
                if ($rule === 'required') {
                    $prop = $prop->required();
                }

                if ($rule === 'nullable') {
                    $prop = $prop->required(false);
                }

                if ($rule === 'string') {
                    $prop = $prop->schema(Schema::string());
                }

                if ($rule === 'integer') {
                    $prop = $prop->schema(Schema::integer());
                }

                if ($rule === 'boolean') {
                    $prop = $prop->schema(Schema::boolean());
                }

                if ($rule === 'array') {
                    $prop = $prop->schema(Schema::array());
                }

                if ($rule === 'date') {
                    $prop = $prop->schema(Schema::string()->format(Schema::FORMAT_DATE));
                }

                // in array
                if (str_contains($rule, 'in:')) {
                    $items = explode(':', $rule)[1];
                    $items = explode(',', $items);
                    $prop = $prop->schema(Schema::string()->enum(...$items));
                }

            }

            $properties[] = $prop;
        }

        return $properties;
    }

    public function parametersSchema(): array
    {
        $properties = [];
        if (method_exists($this, 'rules')) {
            $properties = $this->getQueryParametersFromRules();
        }

        return $properties;
    }
}
