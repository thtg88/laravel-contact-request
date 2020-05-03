<?php

namespace Thtg88\LaravelContactRequest;

use Illuminate\Container\Container;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Thtg88\LaravelContactRequest\LaravelContactRequest as LaravelContactRequestFacade;

class LaravelContactRequestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        AliasLoader::getInstance()
            ->alias(
                'LaravelContactRequest',
                LaravelContactRequestFacade::class
            );

        $this->app->singleton('laravel-contact-request', function () {
            return new LaravelContactRequest();
        });

        // Config
        $this->publishes([
            __DIR__.'/../config/laravel-contact-request.php' => Container::getInstance()
                ->configPath('laravel-contact-request.php'),
        ], 'laravel-contact-request-config');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-contact-request');
        $this->publishes(
            [
                __DIR__.'/../resources/lang' => Container::getInstance()
                    ->resourcePath('lang/vendor/laravel-contact-request'),
            ],
            'laravel-contact-request-translations'
        );

        // Views
        // $this->loadViewsFrom(__DIR__.'/../views', 'laravel-contact-request');
        // $this->publishes([
        //     __DIR__.'/../reousrces/views' => resource_path('views/vendor/laravel-contact-request'),
        // ], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-contact-request.php', 'laravel-contact-request');

        $this->app->singleton(LaravelContactRequest::class, function () {
            return new LaravelContactRequest();
        });

        $this->app->alias(LaravelContactRequest::class, 'laravel-contact-request');
    }

    public function provides(): array
    {
        return ['laravel-contact-request'];
    }
}