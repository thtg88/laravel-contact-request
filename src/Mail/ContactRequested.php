<?php

namespace Thtg88\ContactRequest\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Config;

class ContactRequested extends Mailable
{
    /** @var array<string, string> */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param array<string, string> $data
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
     * @return static
     */
    public function build()
    {
        return $this->subject(Config::get('contact-request.mail.subject'))
            ->view(Config::get('contact-request.mail.views.requested'))
            ->text(Config::get('contact-request.mail.views.requested_plain'))
            ->with('data', $this->data);
    }
}
