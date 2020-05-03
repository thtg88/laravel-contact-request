<?php

return [
    'mail' => [
        'internal_notification_address' => env(
            'LARAVEL_CONTACT_REQUEST_MAIL_INTERNAL_NOTIFICATION_ADDRESS',
            null
        ),
    ],
    'recaptcha' => [
        'mode' => env('LARAVEL_CONTACT_REQUEST_RECAPTCHA_MODE', true),
    ],
    'route_prefix' => env('LARAVEL_CONTACT_REQUEST_ROUTE_PREFIX', ''),
];
