<?php

namespace App\Filament\Resources\GradoResource\Pages;

use Illuminate\Http\Response;

use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\GradoResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class PdfGrado extends Page
{
    use InteractsWithRecord;
    protected static string $resource = GradoResource::class;

    protected static string $view = 'filament.resources.grado-resource.pages.pdf-grado';

    public function mount(int | string $record)
    {
        $this->record = $this->resolveRecord($record);
        $pdf = Pdf::loadView('pdf.test', [
            'record'=> $this->record
        ]);
        return $pdf->stream();
    }
}
