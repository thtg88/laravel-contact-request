<?php

namespace Thtg88\ContactRequest\Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Thtg88\ContactRequest\ContactRequest;
use Thtg88\ContactRequest\ContactRequestServiceProvider;
use Thtg88\ContactRequest\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        ContactRequest::routes();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('contact-request.recaptcha_mode', false);
        $app['config']->set(
            'contact-request.mail.internal_notification_address',
            'mail@example.com'
        );
    }

    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array<int,string>
     */
    protected function getPackageProviders($app)
    {
        return [ContactRequestServiceProvider::class];
    }
}
