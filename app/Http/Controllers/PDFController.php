<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF(Grado $grado)
    {
        // dd($grado);
        $pdf = Pdf::loadView('pdf.test', [
            'grado'=> $grado
        ]);
        return $pdf->stream();
    }
}
