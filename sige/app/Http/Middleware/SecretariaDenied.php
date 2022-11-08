<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Auth;

class SecretariaDenied
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
        if (Auth::check() && strcasecmp(auth()->user()->permissao, 'secretaria') == 0 || Auth::check() && strcasecmp(auth()->user()->permissao, 'pcaadmin') == 0) {
            return $next($request);
        }else{
            return redirect('acessdenied');
        }
    }
}
    

