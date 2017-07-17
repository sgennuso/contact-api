<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( !$this->authorizedIp( $request->ip() ) ) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }

    private function authorizedIp( $ip )
    {
        $audicusIps = config('ips.whitelist');
        $allowedIps = explode(',', env('ALLOWED_IPS'));
        $ips = array_merge($allowedIps, $audicusIps);

        return in_array($ip, $ips);
    }
}
