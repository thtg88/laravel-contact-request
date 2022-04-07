<?php

namespace Thtg88\ContactRequest;

use Illuminate\Container\Container;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Thtg88\ContactRequest\ContactRequest as ContactRequestFacade;

class ContactRequestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        AliasLoader::getInstance()->alias(
            'ContactRequest',
            ContactRequestFacade::class
        );

        $this->app->singleton('contact-request', static function () {
            return new ContactRequest();
        });

        // Config
        $this->publishes([
            __DIR__.'/../config/contact-request.php' => config_path('contact-request.php'),
        ], 'contact-request-config');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'contact-request');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path(
                'views/vendor/contact-request'
            ),
        ], 'contact-request-views');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/contact-request.php', 'contact-request');

        $this->app->singleton(ContactRequest::class, function () {
            return new ContactRequest();
        });

        $this->app->alias(ContactRequest::class, 'contact-request');
    }

    /**
     * @return array<int, string>
     */
    public function provides(): array
    {
        return ['contact-request'];
    }
}
