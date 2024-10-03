<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class FrontendSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Set the session configuration to use frontend specific settings
        Config::set('session.cookie', 'frontend_session');
        Config::set('session.domain', 'frontend.domain.com'); // Change to your frontend domain

        return $next($request);
    }
}
