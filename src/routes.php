<?php

use Illuminate\Support\Facades\Config;
use Thtg88\ContactRequest\ContactRequest;

ContactRequest::routes(null, [
    'prefix' => Config::get('contact-request.route_prefix'),
]);
