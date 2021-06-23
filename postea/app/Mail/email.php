<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class email extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

   
    public function build()
    {
        return $this
        ->subject('Bienvenido a mi aplicacion postea')
        ->view('email.Bienvenida');
    }
}
