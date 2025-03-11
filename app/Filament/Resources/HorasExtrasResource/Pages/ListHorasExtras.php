<?php

namespace App\Filament\Resources\HorasExtrasResource\Pages;

use App\Filament\Resources\HorasExtrasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHorasExtras extends ListRecords
{
    protected static string $resource = HorasExtrasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
