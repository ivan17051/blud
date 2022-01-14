<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $myroles = explode(', ', $request->user()->role);
        $request->attributes->add(['roles' => $myroles]);
        foreach ($myroles as $role) {
            if ( in_array($role, $roles)) {
                return $next($request);
            }
        }

        return back()->with('error', 'Tidak berhak mengakses halaman!');
    }
}
