<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Akses
{ 
    public function handle($request, Closure $next, $level)
    {
        $list_level = explode('|', $level);
        $session = Auth::user()->level;
        if (in_array($session, $list_level)) {
            return $next($request);
        } else {
            return response('Maaf level akses tidak di izinkan','404');
        }
    }
}
