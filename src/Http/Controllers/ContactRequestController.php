<?php

namespace Thtg88\ContactRequest\Http\Controllers;

use Illuminate\Container\Container;
use Illuminate\Routing\ResponseFactory;
use Thtg88\ContactRequest\Http\Requests\SubmitContactRequestRequest;
use Thtg88\ContactRequest\Http\Services\ContactRequestService;

class ContactRequestController
{
    /**
     * Submits a contact request.
     *
     * @param \Thtg88\ContactRequest\Http\Requests\SubmitContactRequestRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(SubmitContactRequestRequest $request)
    {
        $input = (new ContactRequestService())->submit($request);

        return Container::getInstance()->make(ResponseFactory::class)->json([
            'success'         => true,
            'contact_request' => $input,
        ]);
    }
}
