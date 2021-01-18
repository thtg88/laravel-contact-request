<?php

return [
    'mail' => [
        'deliver_later' => env(
            'CONTACT_REQUEST_MAIL_DELIVER_LATER',
            false
        ),
        'internal_subject' => env(
            'CONTACT_REQUEST_MAIL_INTERNAL_SUBJECT',
            'Contact Request Notification'
        ),
        'internal_notification_address' => env(
            'CONTACT_REQUEST_MAIL_INTERNAL_NOTIFICATION_ADDRESS',
            null
        ),
        'signature_name' => env('CONTACT_REQUEST_MAIL_SIGNATURE_NAME', ''),
        'subject'        => env(
            'CONTACT_REQUEST_MAIL_SUBJECT',
            'Contact Request'
        ),
        'views' => [
            'layout' => env(
                'CONTACT_REQUEST_MAIL_VIEWS_LAYOUT',
                'contact-request::layouts.email'
            ),
            'requested' => env(
                'CONTACT_REQUEST_MAIL_VIEWS_REQUESTED',
                'contact-request::emails.contact.requested'
            ),
            'requested_plain' => env(
                'CONTACT_REQUEST_MAIL_VIEWS_REQUESTED_PLAIN',
                'contact-request::emails.contact.requested_plain'
            ),
            'requested_internal' => env(
                'CONTACT_REQUEST_MAIL_VIEWS_REQUESTED_INTERNAL',
                'contact-request::emails.contact.requested_internal'
            ),
            'requested_internal_plain' => env(
                'CONTACT_REQUEST_MAIL_VIEWS_REQUESTED_INTERNAL_PLAIN',
                'contact-request::emails.contact.requested_internal_plain'
            ),
        ],
    ],
    'recaptcha_mode'   => env('CONTACT_REQUEST_RECAPTCHA_MODE', false),
    'route_prefix'     => env('CONTACT_REQUEST_ROUTE_PREFIX', ''),
    'validation_rules' => [
        'email'   => 'required|string|email|max:255',
        'message' => 'required|string|max:4000',
        'name'    => 'required|string|max:255',
        'phone'   => 'required|string|max:255',
    ],
];
