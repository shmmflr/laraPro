<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
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
        return $this->view('emails.test')
            ->to('shmmflr98@gmail.com', 'این یک تست می باشد')
            ->subject('تمرین بخش ایمیل')
            ->with(['date' => '1401/01/19'])
            ->replyTo('shoeib.alinezhad70@gmail.com', 'shoeib')
            ->attach(storage_path('app/public/test.txt'), [
                'as' => 'faktor.txt',
            ])
        // ->attach(storage_path('app/public/helly-bisada.mp3'))
        ;
    }
}