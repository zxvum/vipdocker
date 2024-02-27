<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SurnameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->surname){
            return to_route('profile.view')->with('warning', 'Заполните пожалуйста поле `Фамилия`');
        }

        return $next($request);
    }
}
