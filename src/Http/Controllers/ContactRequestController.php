<?php

namespace Thtg88\LaravelContactRequest\Http\Controllers;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Thtg88\LaravelContactRequest\Http\Requests\SubmitContactRequestRequest;
use Thtg88\LaravelContactRequest\Mail\ContactRequested;
use Thtg88\LaravelContactRequest\Mail\ContactRequestedInternal;

class ContactRequestController
{
    /**
     * Submits a contact request.
     *
     * @param \Thtg88\LaravelContactRequest\Http\Requests\SubmitContactRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(SubmitContactRequestRequest $request)
    {
        $input = $request->validated();

        $contact_requested_mail = new ContactRequested($input);
        $contact_requested_internal_mail = new ContactRequestedInternal($input);

        if (
            Config::get('laravel-contact-request.mail.deliver_later') === true
        ) {
            // TODO: check for specific queue type and name config variables
            $delivery_method = 'later';
        } else {
            $delivery_method = 'send';
        }

        // Send email
        try {
            // Send confirmation mail to user
            Mail::to($input['email'])
                ->$delivery_method($contact_requested_mail);

            // Send internal notification
            Mail::to(Config::get(
                'laravel-contact-request.mail.internal_notification_address'
            ))->$delivery_method($contact_requested_internal_mail);
        } catch (Exception $e) {
            // TODO log errors?
            throw $e;
        }

        return Container::getInstance()->make(ResponseFactory::class)->json([
            'success' => true,
            'contact_request' => $input,
        ]);
    }
}
