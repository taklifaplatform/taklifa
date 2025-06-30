<?php

namespace Modules\Media\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileExtensionRule implements Rule
{
    protected array $validExtensions = [];

    public function __construct(array $validExtensions = [])
    {
        $this->validExtensions = array_map(
            static fn (string $extension): string => strtolower($extension),
            $validExtensions,
        );
    }

    /**
     * @param  string  $attribute
     * @param  \Illuminate\Http\UploadedFile  $value
     */
    public function passes($attribute, $value): bool
    {
        return in_array(
            strtolower($value->getClientOriginalExtension()),
            $this->validExtensions,
            strict: true,
        );
    }

    public function message(): string
    {
        return trans('media-library::validation.mime', [
            'mimes' => implode(', ', $this->validExtensions),
        ]);
    }
}
