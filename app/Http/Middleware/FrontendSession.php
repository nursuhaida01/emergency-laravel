<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class FrontendSession
{
    public function handle($request, Closure $next)
    {
        Config::set('session.cookie', 'frontend_session');
        return $next($request);
    }
}
