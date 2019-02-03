<?php

namespace App\Http\Middleware;

use Closure;

class FilterIfPjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if(!$request->pjax() || !$request->redirection()) {
            return $response;
        }


    }
}
