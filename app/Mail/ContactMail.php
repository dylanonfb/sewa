<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $formData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
       $this->formData=$request; //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact')->subject("Query received")->from($address=env('MAIL_USERNAME'), $name="Sewa Healthlink");
    }
}
