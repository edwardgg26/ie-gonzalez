<?php

namespace App\Filament\Resources\HoraResource\Pages;

use App\Filament\Resources\HoraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHora extends EditRecord
{
    protected static string $resource = HoraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
