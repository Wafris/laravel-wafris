<?php

namespace Wafris;

use Closure;
use Error;
use Illuminate\Http\Request;

class AllowRequestMiddleware
{
    public function __construct(private Core $core)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        abort_unless($this->shouldAllow($request), 403);

        return $next($request);
    }

    protected function shouldAllow(Request $request): bool
    {
        try {
            $response = $this->core->getRedis()->evalsha(
                $this->core->getHash(),
                0,
                $request->ip(),
                ip2long($request->ip()), // TODO: Support ipv6
                time(),
                $request->userAgent(),
                $request->path(),
                $request->getQueryString(),
                $request->host(),
                $request->method()
            );

            return $response !== 'Blocked';
        } catch (Error $e) {
            info('Wafris error: '.$e->getMessage());

            return true;
        }
    }
}
