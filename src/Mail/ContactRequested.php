<?php

namespace Thtg88\LaravelContactRequest\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Config;

class ContactRequested extends Mailable
{
    /** @var array */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param array  $data
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
        return $this->subject(
            Config::get('laravel-contact-request.mail.subject')
        )->view(Config::get('laravel-contact-request.views.requested'))
            ->text(Config::get('laravel-contact-request.views.requested_plain'))
            ->with('data', $this->data);
    }
}
