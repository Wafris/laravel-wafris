<?php

namespace Wafris;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AllowRequestMiddleware
{
    public function __construct(private Core $core) {}


    public function handle(Request $request, Closure $next)
    {
    	abort_unless($this->shouldAllow($request), 403);

        return $next($request);
    }

    protected function shouldAllow(Request $request): bool
    {
    	$response = $this->core->getRedis()->evalsha(
    		$this->core->getHash(),
    		0,
    		$request->ip(),
    		ip2long($request->ip()), // TODO: Support ipv6
    		microtime(),
    		$request->userAgent(),
    		$request->path(),
    		$request->getQueryString(),
    		$request->host(),
    		$request->method()
        );

        var_dump($response);

        return $response !== 'Blocked';
    }
}
