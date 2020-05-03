<?php

return [
    'recaptcha' => [
        'mode' => env('LARAVEL_CONTACT_REQUEST_RECAPTCHA_MODE', true),
    ],
    'route_prefix' => env('LARAVEL_CONTACT_REQUEST_ROUTE_PREFIX', ''),
];
