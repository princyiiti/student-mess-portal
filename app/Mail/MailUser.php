<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
class MailUser extends Mailable
{
    use Queueable, SerializesModels;

    public $data,$messdata,$Rebate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$messdata,$Rebate)
    {
        $this->data = $data;
        $this->messdata =$messdata;
        $this->Rebate = $Rebate;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.rebatetemplate')->subject('Your Rebate Status! ');
    }
}
