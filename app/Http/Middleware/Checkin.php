<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Checkin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN', false);

        redirect()->setIntendedUrl(url()->full());
        if (auth()->check()) {
            return $response;
        } else {
            return redirect('checkin');
        }

    }
}
