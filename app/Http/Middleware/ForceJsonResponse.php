<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/vnd.api+json');
        $request->headers->set('Content-Type', 'application/vnd.api+json');
        return $next($request);
    }
}
