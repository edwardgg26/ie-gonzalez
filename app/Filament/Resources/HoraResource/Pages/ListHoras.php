<?php

namespace App\Filament\Resources\HoraResource\Pages;

use App\Filament\Resources\HoraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHoras extends ListRecords
{
    protected static string $resource = HoraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
