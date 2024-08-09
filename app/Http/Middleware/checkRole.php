<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         // Get the authenticated user
    $user = Auth::user();
    if (!$user) {
        return redirect()->back();
    }
    // Get the user's role
    $role = Role::where('employee_id', $user->id)->first();

    // Check if the user has the "Admin" role
    if ($role && $role->access_role === "Admin") {
        Log::info($role);
        return $next($request);
    } else {
        return redirect()->back();
    }
    }

}
