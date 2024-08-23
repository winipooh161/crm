<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        // Проверка, что пользователь авторизован и имеет роль admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('home'); // Редирект на страницу home
        }

        return $next($request);
    }
}
