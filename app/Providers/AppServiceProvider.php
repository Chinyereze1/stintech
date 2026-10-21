<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Removed the old 'path.public' override that lived here — it was
        // from before we switched to the 'uploads' disk (config/filesystems.php),
        // which handles the public_html/shared-hosting path question directly
        // and doesn't need this override anymore. Leaving it in was dead code
        // that could only cause confusing path bugs, not fix them.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // The footer's "Services" column needs the services list on every
        // page, not just the homepage — a view composer is the clean way to
        // share that without repeating the query in every controller method.
        View::composer('layouts.app', function ($view) {
            $view->with(
                'footerServices',
                Service::where('is_active', true)->orderBy('sort_order')->get()
            );
        });
    }
}
