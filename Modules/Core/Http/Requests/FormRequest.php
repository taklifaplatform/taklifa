<?php

namespace Modules\Core\Http\Requests;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Str;
use Modules\Api\Concerns\Referencable;

class FormRequest extends BaseFormRequest
{
    use Referencable;

    public $schemas = [];

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'message' => __('Invalid data'),
            'errors' => $validator->errors(),
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }

    private function buildRuleProp(string $key, $rules)
    {
        $rules = is_string($rules) ? explode('|', $rules) : $rules;

        if (in_array('integer', $rules)) {
            $prop = Schema::integer($key);
        } elseif (in_array('numeric', $rules)) {
            $prop = Schema::number($key);
        } elseif (in_array('boolean', $rules)) {
            $prop = Schema::boolean($key);
        } elseif (in_array('array', $rules)) {
            $prop = Schema::array($key)->items(Schema::string());
        } else {
            $prop = Schema::string($key);
        }

        foreach ($rules as $rule) {
            if (is_string($rule) && Str::of($rule)->contains('mimes')) {
                $prop = Schema::string($key)->format(Schema::FORMAT_BINARY);
            }
        }

        if (in_array('required', $rules)) {
            $prop = $prop->required();
        }

        return $prop;
    }

    public function updateNestedArray(&$array, $accessor, $value): void
    {
        $keys = explode('.', $accessor);
        $current = &$array;

        foreach ($keys as $key) {
            if (! isset($current[$key]) || ! is_array($current[$key])) {
                $current[$key] = []; // Create an empty array if the key doesn't exist
            }

            $current = &$current[$key]; // Move the reference to the next level
        }

        $current = array_replace_recursive(
            $current,
            $value
        ); // Update the final nested element with the new value
    }

    public function getNestedAccessor($key, $value, &$data, $delimiter = '.*.')
    {
        $keys = Str::of($key)->explode($delimiter);
        $type = $delimiter === '.*.' ? 'array' : 'object';
        $leftKey = $keys[0];
        $rightKey = $keys[1];

        if (count($keys) > 2) {
            unset($keys[0]);
            $rightKey = collect($keys)->implode($delimiter);
        }

        if (! array_key_exists($leftKey, $data) || ! is_array($data[$leftKey])) {
            $data[$leftKey] = [
                '___type' => $type,
                '___items' => [],
                '___rules' => [],
            ];
        }

        if (! array_key_exists($rightKey, $data[$leftKey]['___items'])) {
            $data[$leftKey]['___items'][$rightKey] = [
                '___type' => 'field',
                '___items' => [],
                '___rules' => $value,
            ];
        }

        $data[$leftKey]['___items'][$rightKey]['___type'] = 'field';
        $data[$leftKey]['___items'][$rightKey]['___rules'] = $value;

        if (count($data[$leftKey]['___items'])) {
            $data[$leftKey]['___type'] = $type;
        }

        if (count($data[$leftKey]['___items'][$rightKey]['___items'])) {
            $data[$leftKey]['___items'][$rightKey]['___type'] = $type;
        }

        foreach (['.*.', '.'] as $_delimiter) {
            if (Str::of($rightKey)->contains($_delimiter)) {
                $nestables = $data[$leftKey]['___items'];
                unset($nestables[$rightKey]);
                $items = $this->getNestedAccessor($rightKey, $value, $nestables, $_delimiter);
                $data[$leftKey]['___items'] = array_merge(
                    $nestables,
                    $items
                );
                break;
            }
        }

        if (Str::of($leftKey)->contains('.')) {
            $this->updateNestedArray(
                $data,
                implode('.___items.', explode('.', $leftKey)),
                $data[$leftKey]
            );
            unset($data[$leftKey]);
        }

        return $data;
    }

    private function groupKeys($data)
    {
        $groupedData = [];

        foreach ($data as $key => $value) {
            if (Str::of($key)->contains('.')) {
                $delimiters = ['.*.', '.'];
                foreach ($delimiters as $delimiter) {
                    if (Str::of($key)->contains($delimiter)) {
                        $this->getNestedAccessor($key, $value, $groupedData, $delimiter);
                        break;
                    }
                }
            } else {
                $groupedData[$key] = [
                    '___type' => 'field',
                    '___rules' => $value,
                    '___items' => [],
                ];
            }
        }

        return $groupedData;
    }

    public function getProperties($validationRules, $nested, ?string $schemaName)
    {
        $properties = [];

        foreach ($validationRules as $key => $value) {
            $nestedSchemaName = $schemaName ? Str::of($key.'_'.$schemaName)->studly()->toString() : $key;
            $schema = null;
            if ($value['___type'] == 'field') {
                $properties[] = $this->buildRuleProp($key, $value['___rules']);
            } elseif ($value['___type'] == 'array') {
                $subSchema = Schema::object($nestedSchemaName)->properties(
                    ...collect($value['___items'])
                        ->map(function (array $item, $key) use ($nestedSchemaName) {
                            if ($item['___type'] == 'field') {
                                return $this->buildRuleProp($key, $item['___rules']);
                            }

                            return $this->getProperties([$key => $item], true, $nestedSchemaName);
                        })
                        ->toArray()
                );

                $this->schemas[] = $subSchema;
                $properties[] = Schema::array($key)->items(
                    Schema::ref('#/components/schemas/'.$nestedSchemaName)
                );
            } elseif ($value['___type'] == 'object') {
                $schema = Schema::object($nestedSchemaName)->properties(
                    ...collect($value['___items'])
                        ->map(function (array $item, $key) use ($nestedSchemaName) {
                            if ($item['___type'] == 'field') {
                                return $this->buildRuleProp($key, $item['___rules']);
                            }

                            return $this->getProperties([$key => $item], true, $nestedSchemaName);
                        })
                        ->toArray()
                );
            }

            if ($schema !== null) {
                if ($schemaName) {
                    $this->schemas[] = $schema;
                    $properties[] = Schema::ref('#/components/schemas/'.$nestedSchemaName, $key);
                } else {
                    $properties[] = $schema;
                }
            }
        }

        if ($nested) {
            if (count($properties) === 1) {
                return $properties[0];
            }

            return Schema::object()->properties(
                ...$properties
            );
        }

        return $properties;
    }

    public function getSchemas()
    {
        return $this->schemas;
    }

    public function schema(): Schema
    {
        $properties = [];
        $schemaName = class_basename($this);

        if (method_exists($this, 'rules')) {
            $properties = $this->getProperties($this->groupKeys($this->rules()), false, $schemaName);
        }

        return Schema::object($schemaName)->properties(
            ...$properties
        );
    }

    public function errorsSchema(): Schema
    {
        $properties = [];
        $schemaName = class_basename($this).'ValidationErrors';

        if (method_exists($this, 'rules')) {
            foreach ($this->rules() as $key => $value) {
                $properties[] = Schema::array($key)->items(
                    Schema::string(),
                );
            }
        }

        return Schema::object($schemaName)->properties(
            Schema::object('errors')->properties(
                ...$properties,
            ),
            Schema::string('message')->example('Invalid data'),
        );
    }

    /**
     * Defines OpenAPI documentation for this request.
     */
    public function buildDocs(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(
                    Schema::ref('#/components/schemas/'.class_basename($this))
                )
            )
            ->required(true);
    }

    /**
     * Defines OpenAPI documentation for validation errors.
     */
    public function buildValidationErrorsDocs(): Response
    {
        return Response::ok(class_basename($this).'ValidationResponse')
            ->description('Validation errors')
            ->statusCode(HttpResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->content(
                MediaType::json()->schema(
                    $this->errorsSchema(),
                )
            );
    }
}
