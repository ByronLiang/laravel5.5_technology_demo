<?php

namespace App\Http\Middleware;

use Closure;

class SinglePageWebApplication
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string                   $view
     *
     * @return mixed
     */
    public function handle($request, Closure $next, String $view)
    {
        if ($request->expectsJson() || 'GET' != $request->getMethod() || $request->get('export')) {
            $response = $next($request);
            if ($response instanceof \Illuminate\Http\Response && $response->original instanceof \Illuminate\View\View) {
                abort(404, 'Not Found');
            }

            return $response;
        }

        return response()->view($view);
    }
}
