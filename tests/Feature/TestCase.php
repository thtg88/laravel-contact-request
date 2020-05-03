<?php

namespace Thtg88\LaravelContactRequest\Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Thtg88\LaravelContactRequest\LaravelContactRequest;
use Thtg88\LaravelContactRequest\LaravelContactRequestServiceProvider;
use Thtg88\LaravelContactRequest\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        LaravelContactRequest::routes();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laravel-contact-request.recaptcha.mode', false);
        $app['config']->set(
            'laravel-contact-request.mail.internal_notification_address',
            'mail@example.com'
        );
    }

    /**
     * Load package service provider
     *
     * @param \Illuminate\Foundation\Application $app
     * @return Thtg88\LaravelContactRequest\LaravelContactRequestServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [LaravelContactRequestServiceProvider::class];
    }

    /**
     * Return the route to use for these tests from a given parameters array.
     *
     * @param array $parameters
     * @return string
     */
    abstract public function getRoute(array $parameters = []): string;
}
