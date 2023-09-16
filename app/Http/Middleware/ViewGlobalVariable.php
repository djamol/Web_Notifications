<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class ViewGlobalVariable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cookie::has('user_id')) {
            $userId = Cookie::get('user_id');
        } else {
            $userId = null;
        }
        view()->share('user',User::where('id',$userId)->get());
        view()->share('user_id', $userId);

        return $next($request);
    }
}
