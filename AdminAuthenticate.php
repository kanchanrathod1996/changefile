<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AdminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        return $request->expectsJson() ? null : route('admin.login');
    }

    protected function authenticate($request,array $guards)
    {
        if($this->auth->guard('admin')->check())
        {
            return $this->auth->user('admin');  
        }
        $this->unauthenticated($request,['admin']);
    }
}
