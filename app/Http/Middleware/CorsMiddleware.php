<?php

namespace App\Http\Middleware;

class CorsMiddleware
{
    public function handle($request, \Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            $response = response('', 200);
        } else {
            $response = $next($request);
        }
        $response->headers->add([
            'Access-Control-Allow-Methods' => 'HEAD, GET, POST, PUT, PATCH, DELETE',
            'Access-Control-Allow-Headers' => $request->header('Access-Control-Request-Headers'),
            'Access-Control-Allow-Origin'  => '*',
        ]);
        return $response;
    }
}
