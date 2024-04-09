<?php

namespace AntoniPutra\Ngeblog\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AjaxMiddleware
{
    /**
     * Create a new middleware instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! $request->wantsJson()) {
            abort(404);
        }

        return $next($request);
    }
}