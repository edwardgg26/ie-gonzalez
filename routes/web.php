<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\PublicController;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class,'index'])->name('home');

// Route::get('/admin/grado/{grado}/pdf', [PDFController::class,'generatePDF'])
//     ->middleware([Authenticate::class])
//     ->name('admin.grado.pdf');

// Route::get('/test-mail', function () {
//     Mail::raw('This is a test email', function ($message) {
//         $message->to('test@example.com')->subject('Test Email');
//     });

//     return 'Email sent!';
// });