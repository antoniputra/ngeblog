<?php

namespace AntoniPutra\Ngeblog\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;

class AdminAuthorization
{
    /**
     * Create a new middleware instance.
     */
    public function __construct(protected Gate $gate)
    {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $this->gate->authorize('accessNgeblogAdmin');

        return $next($request);
    }
}