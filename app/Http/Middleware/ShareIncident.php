<?php

// app/Http/Middleware/ShareIncident.php
namespace App\Http\Middleware;

use Closure;
use App\Models\Incident;

class ShareIncident {
    public function handle($request, Closure $next) {
        $incident = Incident::latest()->first();
        view()->share('incident', $incident);
        return $next($request);
    }
}
