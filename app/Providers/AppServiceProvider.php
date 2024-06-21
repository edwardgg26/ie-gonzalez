<?php

namespace App\Providers;

use App\Models\GradoAlumno;
use App\Models\GradoMateria;
use Illuminate\Foundation\Vite;
use Illuminate\Support\HtmlString;
use App\Observers\GradoAlumnoObserver;
use App\Observers\GradoMateriaObserver;
use Illuminate\Support\ServiceProvider;
use Z3d0X\FilamentFabricator\Facades\FilamentFabricator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // FilamentFabricator::pushMeta([
        //     new HtmlString('<link rel="manifest" href="/site.webmanifest" />'),
        // ]);
         
        // //Register scripts
        // FilamentFabricator::registerScripts([
        //     'https://unpkg.com/browse/tippy.js@6.3.7/dist/tippy.esm.js', //external url
        //     app(Vite::class)('resources/css/app.js'), //vite
        //     asset('js/app.js'), // asset from public folder
        // ]);
         
        //Register styles
        FilamentFabricator::registerStyles([
            app(Vite::class)('resources/css/app.css'), //vite
            asset('css/app.css'), // asset from public folder
        ]);
         
        FilamentFabricator::favicon(asset('favicon.ico'));
    }
}
