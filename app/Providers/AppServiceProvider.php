<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Incident;
use App\Models\News;
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
        View::composer(['home', 'incident.index'], function ($view) {
            $newIncidentsCount = Incident::where('status', 'แจ้งเหตุใหม่')->count();
            $view->with('newIncidentsCount', $newIncidentsCount);
        });
         // สำหรับหน้า home และ incident.progress
    View::composer(['home', 'incident.progress'], function ($view) {
        $inProgressCount = Incident::where('status', 'กำลังดำเนินการ')->count();
        $view->with('inProgressCount', $inProgressCount);
    });
    // สำหรับหน้า home และ incident.completed
    View::composer(['home', 'incident.completed'], function ($view) {
        $completedIncidentsCount = Incident::where('status', 'เสร็จสิ้น')->count();
        $view->with('completedIncidentsCount', $completedIncidentsCount);
    });

    View::composer(['news.index', 'dashboard'], function ($view) {
        $view->with('newsItems', News::all());
    });
    View::composer('*', function ($view) {
        $view->with('user', Auth::user());
    });
    }
}
