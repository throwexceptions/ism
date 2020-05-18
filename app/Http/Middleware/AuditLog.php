<?php

namespace App\Http\Middleware;

use Closure;

class AuditLog
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
        $name = auth()->user()->name;
        if($name != 'Super Admin') {
            \App\AuditLog::record([
                'name' => $name,
                'inputs' => $request->input(),
                'url' => $request->url()
            ]);
        }

        return $next($request);
    }
}
