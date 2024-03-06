# Wafris for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wafris/laravel-wafris.svg?style=flat-square)](https://packagist.org/packages/wafris/laravel-wafris)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/wafris/laravel-wafris/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/wafris/laravel-wafris/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/wafris/laravel-wafris/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/wafris/laravel-wafris/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/wafris/laravel-wafris.svg?style=flat-square)](https://packagist.org/packages/wafris/laravel-wafris)

Wafris is an open-source Web Application Firewall (WAF) that runs within Laravel (and other frameworks) powered by Redis. 

Paired with [Wafris Hub](https://wafris.org/hub), you can create rules to block malicious traffic from hitting your application.

![Rules and Graph](docs/rules-and-graph.png)

Rules like:

- Block IP addresses (IPv6 and IPv4) from making requests
- Block on hosts, paths, user agents, parameters, and methods
- Rate limit (throttle) requests 
- Visualize inbound traffic and requests

Need a better explanation? Read the overview at: [wafris.org](https://wafris.org)

## Installation

### 1. Connect on Wafris Hub

Go to https://wafris.org/hub to create a new account and
follow the instructions to link your Redis instance.

**Note:** In Step 3, you'll use this same Redis URL in your app configuration.


### 2. Install this library via Composer

```bash
composer require wafris/laravel-wafris
```

### 3. Publish and configure Wafris

You can publish the config file with:

```bash
php artisan vendor:publish --tag="wafris-config"
```

We recommend creating a separate Redis configuration for Wafris. That can be done in `config/database.php` with a new entry like this:

```php
'redis' => [

    'client' => env('REDIS_CLIENT', 'predis'), // Make sure to set your Redis client to predis

    'options' => [
        ...
    ],

    'default' => [
        ...
    ],

    'cache' => [
        ...
    ],

    'wafris' => [
        'url' => env('REDIS_URL'),
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port' => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_CACHE_DB', '3'),
        'read_write_timeout' => 1, // Timeout in seconds
    ],

],
```

## Usage

Add the `Wafris\AllowRequestMiddleware` middleware to routes that you want to have protected by Wafris.

### Protecting all routes

To protect all routes in your Laravel application, add `Wafris\AllowRequestMiddleware` to the `$middleware` property of your `app/Http/Kernel.php` class.

```php
// app/Http/Kernel.php

/**
 * The application's global HTTP middleware stack.
 *
 * These middleware are run during every request to your application.
 *
 * @var array<int, class-string|string>
 */
protected $middleware = [
    // \App\Http\Middleware\TrustHosts::class,
    \App\Http\Middleware\TrustProxies::class,
    \Illuminate\Http\Middleware\HandleCors::class,
    \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
    \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    \App\Http\Middleware\TrimStrings::class,
    \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    \Wafris\AllowRequestMiddleware::class,
];
```

### Protecting specific middleware groups

To protect specific middleware groups, such as the `web` or `api` groups, add `Wafris\AllowRequestMiddleware` to each desired middleware group in your `app/Http/Kernel.php` class.

```php
// app/Http/Kernel.php

/**
 * The application's route middleware groups.
 *
 * @var array<string, array<int, class-string|string>>
 */
protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Wafris\AllowRequestMiddleware::class,
    ],

    'api' => [
        // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Wafris\AllowRequestMiddleware::class,
    ],
];

```

### Protecting individual routes

Use the `Wafris\AllowRequestMiddleware` middleware when defining your route.

```php
// routes/web.php

Route::get('/signup', function () {
    // ...
})->middleware(\Wafris\AllowRequestMiddleware::class);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributors

- [Mathias Hansen](https://github.com/MiniCodeMonkey)
- [Jaryd Madlena](https://github.com/jmadlena)

## Help / Support

- Email: [support@wafris.org](mailto:support@wafris.org)
- Twitter: [@wafrisorg](https://twitter.com/wafrisorg)
- Booking: https://app.harmonizely.com/expedited/wafris

## License

Elastic License 2.0 - Please see [License File](LICENSE) for more information.

<img src='https://uptimer.expeditedsecurity.com/laravel-wafris' width='0' height='0'>
