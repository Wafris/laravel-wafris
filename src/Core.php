<?php

namespace Wafris;

use Illuminate\Contracts\Redis\Connection as Redis;
use RuntimeException;

class Core
{
    private string $hash;

    public function __construct(private Redis $redis)
    {
    }

    public function load(): void
    {
        $core = file_get_contents(__DIR__.'/lua/dist/wafris_core.lua');
        $this->hash = $this->redis->script('load', $core);

        if (config('database.redis.client' !== 'predis')) {
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
