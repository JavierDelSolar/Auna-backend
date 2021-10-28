<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
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
        $http_origin = $_SERVER['APP_URL'];
        $origins = array('http://localhost:4200', 'http://localhost', 'http://35.173.151.159');
        $http_origin = in_array($http_origin, $origins)?$http_origin:'';
        return $next($request)
            ->header("Access-Control-Allow-Origin", $http_origin)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('"Access-Control-Allow-Headers"', '*'); 
    }
}
