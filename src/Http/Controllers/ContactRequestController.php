<?php

namespace Thtg88\LaravelContactRequest\Http\Controllers;

use Exception;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Mail;
use Thtg88\LaravelContactRequest\Http\Requests\StoreContactRequestRequest;
use Thtg88\LaravelContactRequest\Mail\ContactRequested;
use Thtg88\LaravelContactRequest\Mail\ContactRequestedInternal;

class ContactRequestControllerxw
{
    /**
     * Stores a contact request.
     *
     * @param \Thtg88\LaravelContactRequest\Http\Requests\StoreContactRequestRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreContactRequestRequest $request)
    {
        $input = $request->validated();

        // Send email
        try {
            // Send confirmation mail to user
            Mail::to($input['email'])
                ->send(new ContactRequested($input));

            // Send internal notification
            Mail::to(config('mail.internal_notification_address'))
                ->send(new ContactRequestedInternal($input));
        } catch(Exception $e) {
            // TODO log errors?
        }

        return app(ResponseFactory::class)->json([
            'success' => true,
            'contact_request' => $input,
        ]);
    }
}
