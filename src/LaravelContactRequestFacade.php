<?php

namespace Thtg88\LaravelContactRequest;

use Illuminate\Support\Facades\Facade;

class LaravelContactRequestFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-contact-request';
    }
}
