<?php
// ViewServiceProvider.php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Incident;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $newIncidentsCount = Incident::where('status', 'แจ้งเหตุใหม่')->count();
            $view->with('newIncidentsCount', $newIncidentsCount);
        });
    }
}
