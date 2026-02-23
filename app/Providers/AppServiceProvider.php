<?php

namespace App\Providers;

use App\Models\Complaint;
use App\Observers\ComplaintObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard(); // Disable mass assignment protection globally
        
        // Register Complaint Observer for email notifications
        Complaint::observe(ComplaintObserver::class);
    }
}
