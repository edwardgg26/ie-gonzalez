<?php

namespace App\Filament\Resources\GradoMateriaResource\Pages;

use App\Filament\Resources\GradoMateriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGradoMateria extends EditRecord
{
    protected static string $resource = GradoMateriaResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }
}
