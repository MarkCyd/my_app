<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use Illuminate\Support\Facades\Mail;


class SendSubriberEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSubscribed $event): void
    {
      Mail::raw('thanks for subscribing to the news letter',function($message) use ($event){
        $message->to($event->user->email);//event is out of scope no access need insert code use($event) which connects to usersubs $user to get the email
        $message->subject('thank you'); 
      });
    }
}
