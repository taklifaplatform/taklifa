<?php

namespace Modules\Core\Forms\Components;

use Filament\Forms;
use Filament\Forms\Components\Section;

class MultiLangTextInput
{
    use Forms\Concerns\InteractsWithForms;

    public static function make(string $name, ?string $label = null, bool|\Closure $required = true): Section
    {
        $fields = [];
        $label = $label ?? ucfirst($name);
        foreach (config('filament-language-switch.locales') as $key => $value) {

            $fields[] = Forms\Components\TextInput::make($name.'.'.$key)
                ->label($label.sprintf(' (%s)', $key))
                ->required($required);
        }

        return Section::make($label)
            ->columns(2)
            ->schema($fields);
    }
}
