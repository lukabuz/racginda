<?php

namespace App\Http\Middleware;

use Closure;

class ForcedHTTPS
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
        if (!$request->secure()) {
            $request->setTrustedProxies( [ $request->getClientIp() ] );
            return redirect()->secure($request->getRequestUri());
        }

        $request->setTrustedProxies( [ $request->getClientIp() ] );

        return $next($request); 
    }
}
