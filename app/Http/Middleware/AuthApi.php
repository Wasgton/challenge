<?php

namespace App\Http\Middleware;

use App\Models\ApiAuth;
use Closure;

class AuthApi
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
        $apiKey = $request->header("api-key");
        if(empty($apiKey)){
            return response()->json(['message'=>"API Key not found"], 406);
        }

        $result = ApiAuth::where("key", $apiKey)->first();
        if(empty($result->id)){
            return response()->json(['message'=>"Unauthorized"], 401);
        }

        return $next($request);
    }
}
