<?php

namespace Thtg88\ContactRequest\Http\Services;

use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Thtg88\ContactRequest\Http\Requests\SubmitContactRequestRequest;
use Thtg88\ContactRequest\Mail\ContactRequested;
use Thtg88\ContactRequest\Mail\ContactRequestedInternal;

class ContactRequestService
{
    /**
     * @return array<string,string>
     */
    public function submit(SubmitContactRequestRequest $request): array
    {
        $input = $request->validated();

        $contact_requested_mail = new ContactRequested($input);
        $contact_requested_internal_mail = new ContactRequestedInternal($input);

        if (Config::get('contact-request.mail.deliver_later') === true) {
            // TODO: check for specific queue type and name config variables
            $delivery_method = 'queue';
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
                'contact-request.mail.internal_notification_address'
            ))->$delivery_method($contact_requested_internal_mail);
        } catch (Exception $e) {
            // TODO log errors?
            throw $e;
        }

        return $input;
    }
}
