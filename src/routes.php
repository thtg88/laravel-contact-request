<?php

use Illuminate\Support\Facades\Config;
use Thtg88\LaravelContactRequest\LaravelContactRequest;

LaravelContactRequest::routes(null, [
    'prefix' => Config::get('laravel-contact-request.route_prefix'),
]);
