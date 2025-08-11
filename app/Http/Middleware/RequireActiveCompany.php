<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireActiveCompany
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (! $user || ! $user->active_company_id) {
            return response()->json(['message' => 'Active company not set'], 403);
        }

        app()->instance('activeCompany', $user->activeCompany);

        return $next($request);
    }
}
