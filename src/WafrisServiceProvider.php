<?php

namespace Wafris;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Application;

class WafrisServiceProvider extends PackageServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->singleton(Core::class, function (Application $app) {
            $redis = Redis::connection(config('wafris.redis_connection'));
            $core = new Core($redis);
            $core->load();

            return $core;
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-wafris')
            ->hasConfigFile();
    }
}
