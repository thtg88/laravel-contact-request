<?php

namespace Thtg88\ContactRequest;

use Illuminate\Support\Facades\Facade;

class ContactRequestFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'contact-request';
    }
}
