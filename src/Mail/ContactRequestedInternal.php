<?php

namespace Thtg88\ContactRequest\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Config;

class ContactRequestedInternal extends Mailable
{
    /** @var array */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     *
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
        return $this->subject(Config::get('contact-request.mail.internal_subject'))
            ->view(Config::get('contact-request.mail.views.requested_internal'))
            ->text(Config::get('contact-request.mail.views.requested_internal_plain'))
            ->with('data', $this->data);
    }
}
