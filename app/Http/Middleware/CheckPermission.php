<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $payload = JWTAuth::parseToken()->getPayload();
        $role = json_decode(json_encode($payload['user']->role), true);
        
        if (!$role[$permission]) {
            return response()->json('Unauthorized', 403);
        }

        return $next($request);
    }
}
