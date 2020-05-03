<?php

namespace Thtg88\LaravelContactRequest;

use Illuminate\Support\Facades\Route;

class LaravelContactRequest
{
    /**
     * Binds the mmCMS routes into the controller.
     *
     * @param callable|null $callback
     * @param array $options
     * @return void
     */
    public static function routes($callback = null, array $options = [])
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $defaultOptions = [
            'namespace' => '\Thtg88\LaravelContactRequest\Http\Controllers',
        ];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, static function ($router) use ($callback) {
            $callback(new RouteRegistrar($router));
        });
    }
}
