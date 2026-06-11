<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to.
     */
    protected function redirectTo($request): ?string
    {
        /*
        |--------------------------------------------------------------------------
        | ONLY REDIRECT IF NOT JSON
        |--------------------------------------------------------------------------
        */

        if (! $request->expectsJson()) {

            /*
            |--------------------------------------------------------------------------
            | ADMIN AREA
            |--------------------------------------------------------------------------
            */

            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            /*
            |--------------------------------------------------------------------------
            | USER AREA
            |--------------------------------------------------------------------------
            */

            return route('login');
        }

        return null;
    }
}