<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/22
 * Time: 17:13
 */


namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuth
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->is_admin != 'yes') {
            abort(403);
           // return response('Unauthorized.', 403);
        }

        return $next($request);
    }
}
