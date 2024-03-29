<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\User;
use Illuminate\Database\QueryException;

class Authenticate
{
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            if ($request->has('api_token')) {
                try {
                    $token = $request->input('api_token');
                    $check_token = User::where('api_token', $token)->first();
                    if ($check_token) {
                        $res['status'] = false;
                        $res['message'] = 'Unauthorized';
                        return response($res, 401);
                    }
                } catch (QueryException $ex) {
                    $res['status'] = false;
                    $res['message'] = $ex->getMessage();
                    return response($res, 500);
                }
            } else {
                $res['status'] = false;
                $res['message'] = 'Please login';
                return response($res, 401);
            }
        }
        return $next($request);
    }
}