<?php

namespace App\Http\Middleware\Api\v1;

use Closure;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('api_key') !== 'base64:wMpjcDnogmIW+tjQ4/iFtW/Jyp34S42WRf/RA3skKDw=')
            return response()->json(['error' => true, 'message' => ["ApiKey invalid"]], 401);

        return $next($request);
    }
}
