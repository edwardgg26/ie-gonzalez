<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(){

        // $settings = Setting::all();

        return redirect()->route('filament.admin.auth.login');
    }
}
