<?php

namespace Antoniputra\Ngeblog\Http\Middleware;

use Antoniputra\Ngeblog\Ngeblog;

class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return Ngeblog::check($request) ? $next($request) : abort(403, 'Forbidden :-(');
    }
}
