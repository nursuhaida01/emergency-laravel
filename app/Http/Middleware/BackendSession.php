<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class BackendSession
{
    public function handle($request, Closure $next)
    {
        Config::set('session.cookie', 'backend_session');
        return $next($request);
    }
}
