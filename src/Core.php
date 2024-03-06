<?php

namespace Wafris;

use Illuminate\Contracts\Redis\Connection as Redis;
use RuntimeException;
use Throwable;

class Core
{
    private string $hash;

    public function __construct(private Redis $redis)
    {
    }

    public function load(): void
    {
        try {
            $luaCore = file_get_contents(__DIR__.'/lua/dist/wafris_core.lua');
            $this->hash = $this->redis->script('load', $luaCore);
            $this->redis->hset('waf-settings', 'version', '0.0.3', 'client', 'laravel-wafris')
        } catch (Throwable $e) {
            info('Wafris error: '.$e->getMessage());
        }

        if (config('database.redis.client') !== 'predis') {
            throw new RuntimeException('Please set your redis client configuration to predis');
        }
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getRedis(): Redis
    {
        return $this->redis;
    }
}
