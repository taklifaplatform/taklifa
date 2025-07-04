<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCompanyOwner
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('filament.company.auth.login');
        }

        $user = auth()->user();
        
        if (!$user->isCompanyOwner()) {
            abort(403, 'Access denied. Only company owners can access this panel.');
        }

        return $next($request);
    }
} 