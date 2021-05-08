<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KodingEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($biodata)
    {
        //
        $this->subject('No-Reply');

        $this->biodata = $biodata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('laravelmailto8@gmail.com')
            ->view('isiemail')
            ->with(
            [
                'biodata' => $this->biodata,
            ]);
    }
}
