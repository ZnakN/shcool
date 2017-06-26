<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class cash extends Mailable
{
    use Queueable, SerializesModels;

    public $messages;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
       // $this->from("Etiquette_School@gmail.com");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $from = "Etiquette School";
       $subject = "Уведомление от Etiquette School";
       
       return $this->from("info@etiqschool.com.ua", $from)->subject($subject)->view('mail.cash');
    }
}
