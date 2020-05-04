<?php

return [
    'mail' => [
        'internal_subject' => env(
            'LARAVEL_CONTACT_REQUEST_MAIL_INTERNAL_SUBJECT',
            'Contact Request Notification'
        ),
        'internal_notification_address' => env(
            'LARAVEL_CONTACT_REQUEST_MAIL_INTERNAL_NOTIFICATION_ADDRESS',
            null
        ),
        'subject' => env(
            'LARAVEL_CONTACT_REQUEST_MAIL_SUBJECT',
            'Contact Request'
        ),
    ],
    'recaptcha' => [
        'mode' => env('LARAVEL_CONTACT_REQUEST_RECAPTCHA_MODE', true),
    ],
    'route_prefix' => env('LARAVEL_CONTACT_REQUEST_ROUTE_PREFIX', ''),
    'signature_name' => env('LARAVEL_CONTACT_REQUEST_SIGNATURE_NAME', ''),
    'views' => [
        'layout' => env(
            'LARAVEL_CONTACT_REQUEST_VIEWS_LAYOUT',
            'laravel-contact-request::layouts.email'
        ),
        'requested' => env(
            'LARAVEL_CONTACT_REQUEST_VIEWS_REQUESTED',
            'laravel-contact-request::emails.contact.requested'
        ),
        'requested_plain' => env(
            'LARAVEL_CONTACT_REQUEST_VIEWS_REQUESTED_PLAIN',
            'laravel-contact-request::emails.contact.requested_plain'
        ),
        'requested_internal' => env(
            'LARAVEL_CONTACT_REQUEST_VIEWS_REQUESTED_INTERNAL',
            'laravel-contact-request::emails.contact.requested_internal'
        ),
        'requested_internal_plain' => env(
            'LARAVEL_CONTACT_REQUEST_VIEWS_REQUESTED_INTERNAL_PLAIN',
            'laravel-contact-request::emails.contact.requested_internal_plain'
        ),
    ],
];
