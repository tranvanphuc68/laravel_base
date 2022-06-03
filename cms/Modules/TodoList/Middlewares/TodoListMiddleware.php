<?php

namespace Cms\Modules\TodoList\Middlewares;

use Closure;

class TodoListMiddleware
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
        // do something here...
    }
}

