<?php

namespace Thtg88\ContactRequest;

use Illuminate\Support\Facades\Route;

class ContactRequest
{
    /**
     * Binds the mmCMS routes into the controller.
     *
     * @param callable|null        $callback
     * @param array<string,string> $options
     *
     * @return void
     */
    public static function routes($callback = null, array $options = [])
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $defaultOptions = [
            'namespace' => '\Thtg88\ContactRequest\Http\Controllers',
        ];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, static function ($router) use ($callback) {
            $callback(new RouteRegistrar($router));
        });
    }
}
