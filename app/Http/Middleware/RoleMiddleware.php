<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$abilities)
    {
       $assigned_abilities = auth('sanctum')->user()->tokens->first()->abilities;
        foreach($abilities as $ability){
            if(in_array($ability,$assigned_abilities)){
                return $next($request);
            }
        }

        abort('401','Access Denied');
    }

    }

