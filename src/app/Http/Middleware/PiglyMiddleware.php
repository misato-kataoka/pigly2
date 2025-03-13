<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PiglyMiddleware
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
        // ユーザーが認証されていない場合、ログインページにリダイレクト
        if (!$request->user()) {
            return redirect('/login')->with('error', 'ログインが必要です。');
        }

        return $next($request);
    }
}
