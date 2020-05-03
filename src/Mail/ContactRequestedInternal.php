<?php

namespace Thtg88\LaravelContactRequest\Mail;

use Illuminate\Mail\Mailable;

class ContactRequestedInternal extends Mailable
{
    /** @var array */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('marco-marassi.com - Contact Request Notification')
            ->view('laravel-contact-request::emails.contact.requested_internal')
            ->text('laravel-contact-request::emails.contact.requested_internal_plain')
            ->with('data', $this->data);
    }
}
