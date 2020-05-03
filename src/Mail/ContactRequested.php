<?php

namespace Thtg88\LaravelContactRequest\Mail;

use Illuminate\Mail\Mailable;

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
        return $this->subject('Contact Request - marco-marassi.com')
            ->view('emails.contact.requested')
            ->text('emails.contact.requested_plain')
            ->with('data', $this->data);
    }
}
