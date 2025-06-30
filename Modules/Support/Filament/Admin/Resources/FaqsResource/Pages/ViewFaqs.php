<?php

namespace Modules\Support\Filament\Admin\Resources\FaqsResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\Support\Filament\Admin\Resources\FaqsResource;

class ViewFaqs extends ViewRecord
{
    protected static string $resource = FaqsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('FAQ Information'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('title')
                                            ->label(__('Title'))
                                            ->size(TextEntrySize::Medium),

                                        Components\TextEntry::make('order')
                                            ->label(__('Order'))
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('created_at')
                                            ->label(__('Created at'))
                                            ->dateTime()
                                            ->color('success')
                                            ->badge(),

                                        Components\TextEntry::make('updated_at')
                                            ->label(__('Updated at'))
                                            ->dateTime()
                                            ->badge(),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),

                Components\Section::make(__('Content'))
                    ->schema([
                        Components\TextEntry::make('content')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
