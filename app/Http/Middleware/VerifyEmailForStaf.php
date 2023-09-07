<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailForStaf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and belongs to group 'staf'
        if ($request->user() && $request->user()->id_grup == 2) {
            // Check if the user's email is verified
            if (!$request->user()->hasVerifiedEmail()) {
                // Redirect to a page indicating that email verification is required
                return redirect('/verify-email');
            }
        }
        
        return $next($request);
    }
}
