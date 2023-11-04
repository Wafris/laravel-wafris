# Wafris for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wafris/laravel-wafris.svg?style=flat-square)](https://packagist.org/packages/wafris/laravel-wafris)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/wafris/laravel-wafris/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/wafris/laravel-wafris/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/wafris/laravel-wafris/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/wafris/laravel-wafris/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/wafris/laravel-wafris.svg?style=flat-square)](https://packagist.org/packages/wafris/laravel-wafris)

Wafris is an open-source Web Application Firewall (WAF) that runs within Rails (and other frameworks) powered by Redis. 

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

### 3. Publush and configure Wafris

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-wafris-config"
```

## Usage

```php
$wafris = new Wafris();
echo $wafris->echoPhrase('Hello, Wafris!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Help / Support

- Email: [support@wafris.org](mailto:support@wafris.org)
- Twitter: [@wafrisorg](https://twitter.com/wafrisorg)
- Booking: https://app.harmonizely.com/expedited/wafris

<img src='https://uptimer.expeditedsecurity.com/wafris-rb' width='0' height='0'>

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
